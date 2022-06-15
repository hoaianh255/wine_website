<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class MngOrderDetailController extends Controller
{
    public function index(){
        $orderNumber = 1;
        $orderdetails = OrderDetail::orderBy('created_at','desc')->paginate(12);
        return view('admin.orderdetail')->with(["orderdetails"=>$orderdetails,"orderNumber"=>$orderNumber]);
    }
    public function orderPro($order)
    {
      if($order === "old"){
        $orderNumber = 1;
        $orderdetails = OrderDetail::paginate(12);
        $old = "selected";
        return view('admin.orderdetail',compact('orderdetails','old','orderNumber'));
      }
        $orderNumber = 1;
        $new = "selected";
        $orderdetails = OrderDetail::orderBy('created_at','desc')->paginate(12);
        return view('admin.orderdetail',compact('orderdetails','new','orderNumber'));
    }
    public function search(Request $request){
        $orderNumber = 1;
        $orderdetails = OrderDetail::where('product_name','like','%'.$request->product_name.'%')->paginate(12);
        return view('admin.orderdetail')->with(["orderdetails"=>$orderdetails,"orderNumber"=>$orderNumber]);
    }
}
