<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Ui\Presets\React;

class CuponController extends Controller
{
    public function index(){
        $pageTitle = 'All Cupon Lists';
        $cupons = Cupon::orderBy('created_at','desc')->paginate(getPaginate(12));
        return view('admin.cupon.index',compact('cupons','pageTitle'));
    }

    public function store(Request $request){
        $request->validate([
            'cupon' => 'required|max:190|unique:cupons',
            'discount' =>'required',
            'validity_days' =>'required',
        ]);

        $cupon = new Cupon();
        $cupon->cupon = $request->cupon;
        $cupon->discount = $request->discount;
        $cupon->validity_days =$request->validity_days;
        $cupon->expire_date =  now()->addDays($cupon->validity_days);
        $cupon->status = $request->status ? 1 : 0;
        $cupon->save();

        $notify[] = ['success', 'Cupon has been  created successfully'];
        return back()->withNotify($notify);
    }

    public function update(Request $request){
        $request->validate([
            'cupon' => 'required|max:190',
            'discount' =>'required',
            'validity_days' =>'required',
        ]);

        $cupon = Cupon::find($request->id);
        $cupon->cupon = $request->cupon;
        $cupon->discount = $request->discount;
        $cupon->validity_days =$request->validity_days;
        $cupon->expire_date =  now()->addDays($cupon->validity_days);
        $cupon->status = $request->status ? 1 : 0;
        $cupon->save();
        $notify[] = ['success', 'Cupon has been Updated successfully'];
        return back()->withNotify($notify);
    }

    public function delete($id){
        $cupon = Cupon::find($id);
        $cupon->delete();

        $notify[] = ['error', 'Cupon has been deleted successfully'];
        return back()->withNotify($notify);
    }
}
