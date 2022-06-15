<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MngOrderController extends Controller
{
    public function index(){
        $newDateTime = Carbon::now()->addDays(5);
        $orderNumber = 1;
        $orders = Order::orderBy('created_at','desc')->paginate(12);
        return view('admin.order.index')->with(["orders"=>$orders,"orderNumber"=>$orderNumber,"newDateTime"=>$newDateTime]);
    }
    public function orderPro($order)
    {
      if($order === "old"){
        $orderNumber = 1;
        $orders = Order::paginate(12);
        $old = "selected";
        return view('admin.order.index',compact('orders','old','orderNumber'));
      }
        $orderNumber = 1;
        $new = "selected";
        $orders = Order::orderBy('created_at','desc')->paginate(12);
        return view('admin.order.index',compact('orders','new','orderNumber'));
    }
    public function search(Request $request){
        $orderNumber = 1;
        $orders = Order::where('user_name','like','%'.$request->user_name.'%')->paginate(12);
        return view('admin.order.index')->with(["orders"=>$orders,"orderNumber"=>$orderNumber]);
    }

    public function update(Request $request,$id)
    {
      $orders = Order::find($id);
      if(isset($request->status)){
        $orders->status = $request->status;
      }
      $saved = $orders->save();
      session()->flash('message','success');
      return redirect()->route('MngOrder.index');
    }

    public function UNupdate(Request $request,$id)
    {
      $orders = Order::find($id);
      if(isset($request->status)){
        $orders->status = $request->status;
      }
      $saved = $orders->save();
      session()->flash('message','success');
      return redirect()->route('MngOrder.index');
    }

    public function destroy(Order $id)
    {
      $id->delete();
      OrderDetail::whereIn('order_id',$id)->delete();
      session()->flash('message', 'Xóa Người dùng thành công');
      return redirect()->back();
    }

    public function deleteAll(Request $request) {
      $OrderId = explode(',',$request->OrderId[0]);
      $deleted = Order::whereIn('id',$OrderId)->delete();
      if($deleted) {
        return redirect()->back()->with('message', 'Da xoa thanh cong');
      }
      return redirect()->back()->with('message', 'Xoa khong thanh cong');
    }
}
