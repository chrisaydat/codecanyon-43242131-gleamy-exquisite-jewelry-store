<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Page;
use App\Models\User;
use App\Models\Cupon;
use App\Models\Deposit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Frontend;
use App\Models\Language;
use App\Lib\FormProcessor;
use App\Models\Subscriber;
use App\Models\Transaction;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use App\Models\GatewayCurrency;
use App\Rules\FileTypeValidate;
use App\Models\AdminNotification;
use App\Models\CustomOrder;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function index(){
        $reference = @$_GET['reference'];
        if ($reference) {
            session()->put('reference', $reference);
        }
        $pageTitle = 'Home';
        $sections = Page::where('tempname',$this->activeTemplate)->where('slug','/')->first();
        return view($this->activeTemplate . 'home', compact('pageTitle','sections'));
    }

    public function pages($slug)
    {
        $page = Page::where('tempname',$this->activeTemplate)->where('slug',$slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle','sections'));
    }


    public function contact()
    {
        $pageTitle = "Contact Us";
        return view($this->activeTemplate . 'contact',compact('pageTitle'));
    }

    public function subscribe(Request $request){

        $request->validate([
            'email'=>'required|unique:subscribers',
        ]);

        $subscribe=new Subscriber();
        $subscribe->email=$request->email;
        $subscribe->save();

        $notify[] = ['success','You have successfully subscribed to the Newsletter'];
        return back()->withNotify($notify);

    }


    public function contactSubmit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        if(!verifyCaptcha()){
            $notify[] = ['error','Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $request->session()->regenerateToken();

        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view',$ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function policyPages($slug,$id)
    {
        $policy = Frontend::where('id',$id)->where('data_keys','policy_pages.element')->firstOrFail();
        $pageTitle = $policy->data_values->title;
        return view($this->activeTemplate.'policy',compact('policy','pageTitle'));
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return back();
    }
    public function blog(){

        $pageTitle = 'Blog';
        $sections = Page::where('tempname',$this->activeTemplate)->where('slug','blog')->firstOrFail();
        $blogs = Frontend::where('data_keys','blog.element')->orderBy('id','desc')->paginate(getPaginate(20));
        $contacts = Frontend::where('data_keys','contact_us.content')->orderBy('id','desc')->firstOrFail();
        $latests = Frontend::where('data_keys','blog.element')->orderBy('id','desc')->limit(5)->get();

        return view($this->activeTemplate.'blog.blog',compact('sections','blogs','contacts','latests','pageTitle'));
    }

    public function blogDetails($slug,$id){
        $blog = Frontend::where('id',$id)->where('data_keys','blog.element')->firstOrFail();
        $pageTitle = 'Blog Details';
        $latests   =Frontend::where('data_keys','blog.element')->orderBy('id','desc')->limit(5)->get();
        return view($this->activeTemplate.'blog_details',compact('latests','blog','pageTitle'));
    }

 // product
    public function shop(){
        $pageTitle = 'Products';
        $sections = Page::where('tempname',$this->activeTemplate)->where('slug','shop')->firstOrFail();
        $products = Product::orderBy('created_at','desc')->with('producutImages')->paginate(getPaginate(20));
        return view($this->activeTemplate.'products.products',compact('products', 'sections', 'pageTitle'));
    }

    public function productDetail($slug,$id){
        $pageTitle = "Product Detail";
        $productDetail = Product::find($id);
        $productImages = ProductImage::where('product_id', $id)->get();
        return view($this->activeTemplate.'products.product_details',compact('productImages','productDetail','pageTitle'));
    }


    public function cookieAccept(){
        $general = gs();
        Cookie::queue('gdpr_cookie',$general->site_name , 43200);
        return back();
    }

    public function cookiePolicy(){
        $pageTitle = 'Cookie Policy';
        $cookie = Frontend::where('data_keys','cookie.data')->first();
        return view($this->activeTemplate.'cookie',compact('pageTitle','cookie'));
    }

    public function placeholderImage($size = null){
        $imgWidth = explode('x',$size)[0];
        $imgHeight = explode('x',$size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if($imgHeight < 100 && $fontSize > 30){
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 255, 255, 255);
        $bgFill    = imagecolorallocate($image, 28, 35, 47);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    // cart
    public function getCart(){
        $pageTitle = "Your Cart";
        return view($this->activeTemplate.'cart.cart',compact('pageTitle'));
    }



    public function addCart(Request $request, $id){
        $this->validate($request, [
            'quantity'  =>'required|gt:0'
        ]);


        $product = Product::findOrFail($id);
        $productImage=ProductImage::where('product_id',$product->id)->first();

        if($product->quantity < $request->quantity){
            $notify[] = ['warning', 'Products out of stock'];
           return back()->withNotify($notify);
        }

        $cart = session()->get('cart', []);

        $discount =($product->price)- ($product->price * $product->discount/100 );
        if($product->discount != 0){
            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "quantity" =>$request->quantity,
                    "price" =>  $discount,
                    "image" => $productImage->image,
                    "url" => $productImage->url
                ];
            }
        }else{
            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "quantity" =>$request->quantity,
                    "price" => $product->price,
                    "image" => $productImage->image,
                    "url" => $productImage->url
                ];
            }
        }
        session()->put('cart', $cart);


        $notify[] = ['success', 'Product added to cart successfully!'];
        return back()->withNotify($notify);

     }

     public function UpdateCart(Request $request)
     {
         if($request->id && $request->quantity){
             $cart = session()->get('cart');
             $cart[$request->id]["quantity"] = $request->quantity;
             session()->put('cart', $cart);

             $notify[] = ['success', 'Product cart updated successfully!'];
             return back()->withNotify($notify);
         }
     }

     public function RemoveCart(Request $request)
     {
         if($request->id) {
             $cart = session()->get('cart');
             if(isset($cart[$request->id])) {
                 unset($cart[$request->id]);
                 session()->put('cart', $cart);
             }
          return 200;
         }
     }


    // checkout
    public function getChectout(){
        $pageTitle = "Checkout";
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();
        $info = json_decode(json_encode(getIpInfo()), true);
        $mobileCode = @implode(',', $info['code']);
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return view($this->activeTemplate.'checkout.checkout',compact('gatewayCurrency','mobileCode','countries','pageTitle'));
    }

    // category  product
    public function categoryProduct($slug, $id){
        $category = Category::find($id);
        $sections = Page::where('tempname',$this->activeTemplate)->where('slug','shop')->firstOrFail();
        $pageTitle = $category->name;
        $products = Product::where('category_id',$category->id)->orderBy('created_at','desc')->with('producutImages')->paginate(getPaginate(20));
        return view($this->activeTemplate.'products.products',compact('products','sections','pageTitle'));
    }

    // search product
    public function search(Request $request){
        $pageTitle = 'Products Search';
        $sections = Page::where('tempname',$this->activeTemplate)->where('slug', 'shop')->firstOrFail();
        $products = Product::latest()->filter(request(['search']))->with('producutImages')->paginate(getPaginate(12));
        return view($this->activeTemplate.'products.products',compact('products', 'sections', 'pageTitle'));
    }

    // apply cupon
    public function applyCupon(Request $request){
        $cupon=$request->cupon;
        $checkCupon = Cupon::where('cupon',$cupon)->first();
        if(@$checkCupon->status !=1){
            $notify[] = ['error', 'Cant not this Cupon Code'];
            return back()->withNotify($notify);
        }
        if(@$checkCupon->expire_date < now()){

            $notify[] = ['error', 'Your cupon code has been expired'];
            return back()->withNotify($notify);
        }

        if($checkCupon){
            Session::put('cupon',[
                'name'=>$checkCupon->cupon,
                'discount'=>$checkCupon->discount,
            ]);
            $notify[] = ['success', 'Cupon applied successfully!'];
            return back()->withNotify($notify);


        }else{
            $notify[] = ['warning', 'Cupon applied Wrong!'];
            return back()->withNotify($notify);
        }

    }

    public function getCustomOrder(){
        $pageTitle = 'Custom Order';
        return view($this->activeTemplate.'custom_order.custom_order',compact('pageTitle'));
    }

    public function storeCustomOrder(Request $request){
        $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'images.*' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],

        ]);

        $customOrder = new CustomOrder();
        $customOrder->user_id = auth()->check() ? auth()->user()->id : 0;
        $customOrder->name = $request->name;
        $customOrder->email = $request->email;
        $customOrder->short_desc = $request->short_desc;

        if ($request->hasFile('image')) {

                  try {
                    $directory = date("Y")."/".date("m");
                    $customOrder->path = $directory;
                    $path       = getFilePath('customProductImages').'/'.$directory;
                    $customOrder->Image = fileUploader($request->image, $path, getFileSize('customProductImages'));

                  } catch (\Exception $exp) {
                      $notify[] = ['error', 'Couldn\'t upload your image'];
                      return back()->withNotify($notify);
                  }
                  $customOrder->save();

            }
            $notify[] = ['success', 'Request Order has been  created successfully'];
            return back()->withNotify($notify);
    }


}
