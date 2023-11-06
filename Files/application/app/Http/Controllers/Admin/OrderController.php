<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomOrder;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use ReflectionFunctionAbstract;

class OrderController extends Controller
{
    public function index(){
        $pageTitle = "Oders List";
        $orders = Order::with(['products'])->orderBy('created_at','desc')->paginate(getPaginate(10));
        return view('admin.orders.index',compact('orders','pageTitle'));
    }

    public function orderDetail($id){
        $pageTitle = "Oders Detail";
        $orderDetails = Order::with(['products', 'products.producutImages'])->find($id);
        return view('admin.orders.order_details',compact('orderDetails','pageTitle'));
    }

    public function orderApprove(Request $request, $id){

        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();

        if($order->user_id != 0){
        $userFind = User::find($order->user_id);
        $user = $userFind;

         notify($user, 'ORDER_ON_PROCESSING_CONFIRMATION', [
            'order_number'=>$order->order_number,
            'product_price' => showAmount($order->product_price)
        ]);
        }

        $notify[] = ['success', 'Product has been  Approved successfully'];
        return back()->withNotify($notify);
    }

    public function orderReject($id){
        $order = Order::find($id);
        $order->status = 4;
        $order->save();

        $notify[] = ['warning', 'Product has been  Rejected successfully'];
        return back()->withNotify($notify);
    }

    public function getCustomOrders(){
        $pageTitle = 'Custom Orders List';
        $customOrders = CustomOrder::orderBy('created_at','desc')->paginate(getPaginate(12));
        return view('admin.custom_order.list',compact('customOrders','pageTitle'));

    }

    public function customOrderDetails($id){
        $pageTitle = 'Custom Orders Details';
        $customOrders = CustomOrder::find($id);
        return view('admin.custom_order.customOrderDetails',compact('customOrders','pageTitle'));
    }
}
