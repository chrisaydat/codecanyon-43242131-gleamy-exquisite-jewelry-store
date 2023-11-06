<?php

namespace App\Http\Controllers\Gateway;

use App\Models\User;
use App\Models\Order;
use App\Models\Deposit;
use App\Models\Product;
use App\Lib\FormProcessor;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GatewayCurrency;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{

    public function deposit()
    {

    $pageTitle = "Checkout";
    $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
        $gate->where('status', 1);
    })->with('method')->orderby('method_code')->get();
    $info = json_decode(json_encode(getIpInfo()), true);
    $mobileCode = @implode(',', $info['code']);
    $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
    return view($this->activeTemplate.'checkout.checkout',compact('gatewayCurrency','mobileCode','countries','pageTitle'));

}

    public function depositInsert(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|gt:0',
            'method_code' => 'required',
            'currency' => 'required',
            'currency' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

         $productSession = session('cart');

         $total=0;
         $quantity=0;
         foreach (session('cart') as $id => $details) {
            $total += @$details['price'] * @$details['quantity'];
            $quantity +=  @$details['quantity'];
        }

        // order table data insert
        if (Session::has('cupon')){
            $order = new Order();
            $order->user_id = auth()->check() ? auth()->user()->id : 0;
            $order->order_number = Str::random(4).now()->format('dmY');
            $order->quantity = $quantity;
            $order->firstname =  auth()->check() ? auth()->user()->firstname : $request->firstname;
            $order->lastname =  auth()->check() ? auth()->user()->lastname : $request->lastname;
            $order->email = auth()->check() ? auth()->user()->email : $request->email ;
            $order->phone = auth()->check() ? auth()->user()->mobile : $request->mobile;
            $order->address =auth()->check()? auth()->user()->address->address : $request->address;
            $order->product_price = ($total)- ($total * Session::get('cupon')['discount']/100 );
            $order->status = 0;
            $order->save();
        }else{
            $order = new Order();
            $order->user_id = auth()->check() ? auth()->user()->id : 0;
            $order->order_number = Str::random(4).now()->format('dmY');
            $order->quantity = $quantity;
            $order->firstname =  auth()->check() ? auth()->user()->firstname : $request->firstname;
            $order->lastname =  auth()->check() ? auth()->user()->lastname : $request->lastname;
            $order->email = auth()->check() ? auth()->user()->email : $request->email ;
            $order->phone = auth()->check() ? auth()->user()->mobile : $request->mobile;
            $order->address =auth()->check()? auth()->user()->address->address : $request->address;
            $order->product_price = $total;
            $order->status = 0;
            $order->save();
        }


        if($order->user_id !=0){
            $adminNotification = new AdminNotification();
            $adminNotification->user_id = auth()->check() ? auth()->user()->id : 0;
            $adminNotification->title = 'Order request from'.$order->firstname.$order->lastname;
            $adminNotification->click_url = urlPath('admin.orders.detail',$order->id);
            $adminNotification->save();

        }else{
            $adminNotification = new AdminNotification();
            $adminNotification->user_id = 0;
            $adminNotification->title = 'Order request from guest user';
            $adminNotification->click_url = urlPath('admin.orders.detail',$order->id);
            $adminNotification->save();
        }


        foreach($productSession as $item)
        {
           $order->products()->attach($item['id'],['product_quantity'=>$item['quantity']]);
        }


        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->where('method_code', $request->method_code)->where('currency', $request->currency)->first();
        if (!$gate) {
            $notify[] = ['error', 'Invalid gateway'];
            return back()->withNotify($notify);
        }

        if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
            $notify[] = ['error', 'Please follow deposit limit'];
            return back()->withNotify($notify);
        }

        $charge = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
        $payable = $request->amount + $charge;
        $final_amo = $payable * $gate->rate;

        $data = new Deposit();
        $data->user_id = auth()->check() ? auth()->user()->id : 0 ;
        $data->method_code = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->order_id =  $order->id;
        $data->amount = $request->amount;
        $data->charge = $charge;
        $data->rate = $gate->rate;
        $data->final_amo = $final_amo;
        $data->btc_amo = 0;
        $data->btc_wallet = "";
        $data->trx = getTrx();
        $data->try = 0;
        $data->status = 0;
        $data->save();
        session()->put('Track', $data->trx);
        if(auth()->user()){
            return to_route('user.deposit.confirm');
        }else{
            return to_route('deposit.confirm');
        }
    }


    public function appDepositConfirm($hash)
    {
        try {
            $id = decrypt($hash);
        } catch (\Exception $ex) {
            return "Sorry, invalid URL.";
        }
        $data = Deposit::where('id', $id)->where('status', 0)->orderBy('id', 'DESC')->firstOrFail();
        $user = User::findOrFail($data->user_id);
        auth()->login($user);
        session()->put('Track', $data->trx);
        if(auth()->user()){
            return to_route('user.deposit.confirm');
        }else{
            return to_route('deposit.confirm');
        }
    }


    public function depositConfirm()
    {
        $track = session()->get('Track');
        $deposit = Deposit::where('trx', $track)->where('status',0)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();

        if ($deposit->method_code >= 1000) {
            if(auth()->user()){
                return to_route('user.deposit.manual.confirm');
            }else{
                return to_route('deposit.manual.confirm');
            }
        }



        $dirName = $deposit->gateway->alias;
        $new = __NAMESPACE__ . '\\' . $dirName . '\\ProcessController';

        $data = $new::process($deposit);
        $data = json_decode($data);


        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return to_route(gatewayRedirectUrl())->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }

        // for Stripe V3
        if(@$data->session){
            $deposit->btc_wallet = $data->session->id;
            $deposit->save();
        }

        $pageTitle = 'Payment Confirm';
        return view($this->activeTemplate . $data->view, compact('data', 'pageTitle', 'deposit'));
    }


    public static function userDataUpdate($deposit,$isManual = null)
    {
        if ($deposit->status == 0 || $deposit->status == 2) {
            $deposit->status = 1;
            $deposit->save();

            if($deposit->order_id){
                $order = Order::find($deposit->order_id);
                $order->status = 1;
                $order->save();
            }

            if( $order->user != 0){
                $user = User::find($deposit->user_id);
                $user->balance += $deposit->amount;
                $user->save();
            }

            $transaction = new Transaction();
            $transaction->user_id = $deposit->user_id;
            $transaction->amount = $deposit->amount;
            $transaction->post_balance =  auth()->check() ? auth()->user()->balance : 0;
            $transaction->charge = $deposit->charge;
            $transaction->trx_type = '+';
            $transaction->details = 'Deposit Via '. $deposit->gatewayCurrency()->name;
            $transaction->trx = $deposit->trx;
            $transaction->remark = 'deposit';
            $transaction->save();

            if($deposit->order_id){
                $order = Order::find($deposit->order_id);
                foreach ($order->products as $product) {
                    $ProductIid = $product->pivot->product_id;
                    $TotalQuantity = $product->pivot->product_quantity;

                    $product = Product::find($ProductIid);
                    $product->quantity -= $TotalQuantity;
                    $product->save();
                }

            }

            if (!$isManual) {
                $adminNotification = new AdminNotification();
                $adminNotification->user_id = $user->id;
                $adminNotification->title = 'Deposit successful via '.$deposit->gatewayCurrency()->name;
                $adminNotification->click_url = urlPath('admin.deposit.successful');
                $adminNotification->save();
            }

            if( $order->user != 0){

                notify($user, $isManual ? 'DEPOSIT_APPROVE' : 'DEPOSIT_COMPLETE', [
                    'method_name' => $deposit->gatewayCurrency()->name,
                    'method_currency' => $deposit->method_currency,
                    'method_amount' => showAmount($deposit->final_amo),
                    'amount' => showAmount($deposit->amount),
                    'charge' => showAmount($deposit->charge),
                    'rate' => showAmount($deposit->rate),
                    'trx' => $deposit->trx,
                    'post_balance' => showAmount($user->balance)
                ]);
            }
        }
    }

    public function manualDepositConfirm()
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return to_route(gatewayRedirectUrl());
        }
        if ($data->method_code > 999) {

            $pageTitle = 'Deposit Confirm';
            $method = $data->gatewayCurrency();
            $gateway = $method->method;
            if(auth()->user()){
                return view($this->activeTemplate . 'user.payment.manual', compact('data', 'pageTitle', 'method','gateway'));

            }else{
                return view($this->activeTemplate . 'user.payment.manual_nonuser', compact('data', 'pageTitle', 'method','gateway'));

            }
        }
        abort(404);
    }

    public function manualDepositUpdate(Request $request)
    {


        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return to_route(gatewayRedirectUrl());
        }
        $gatewayCurrency = $data->gatewayCurrency();
        $gateway = $gatewayCurrency->method;
        $formData = $gateway->form->form_data;

        $formProcessor = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData = $formProcessor->processFormData($request, $formData);


        $data->detail = $userData;
        $data->status = 2; // pending
        $data->save();


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $data->user_id != 0 ? $data->user->id : 0;
        $adminNotification->title = 'Deposit request from ';
        $adminNotification->click_url = urlPath('admin.deposit.details',$data->id);
        $adminNotification->save();


     if(!empty(auth()->user)){
        notify($data->user, 'DEPOSIT_REQUEST', [
            'method_name' => $data->gatewayCurrency()->name,
            'method_currency' => $data->method_currency,
            'method_amount' => showAmount($data->final_amo),
            'amount' => showAmount($data->amount),
            'charge' => showAmount($data->charge),
            'rate' => showAmount($data->rate),
            'trx' => $data->trx
        ]);
    }
         session()->forget('cart');
         session()->forget('cupon');

        $notify[] = ['success', 'Your request has been taken'];
        // return to_route('user.deposit.history')->withNotify($notify);
        return to_route('home')->withNotify($notify);


    }


}
