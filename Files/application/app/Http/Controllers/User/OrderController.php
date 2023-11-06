<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CustomOrder;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $pageTitle = "Order Lists";
        $user = auth()->user();
        $orders = Order::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(getPaginate(10));
        return view($this->activeTemplate.'user.orders.index',compact('orders','pageTitle'));
    }

    public function orderDetails($id){
        $pageTitle ="Order Details";
        $order = Order::with(['products', 'products.producutImages'])->find($id);
        return view($this->activeTemplate.'user.orders.order_detail',compact('order','pageTitle'));
    }

    public function getCustomOrders(){
        $pageTitle ="Custom Orders";
        $customOrder = CustomOrder::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->paginate(getPaginate(10));
        return view($this->activeTemplate.'custom_order.list',compact('pageTitle','customOrder'));
    }

    public function customOrdersDetails($id){
        $pageTitle ="Custom Orders Details";
        $customOrder = CustomOrder::find($id);
        return view($this->activeTemplate.'custom_order.customOrderDetails',compact('pageTitle','customOrder'));
    }


}
