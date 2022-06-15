<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MngCouponController extends Controller
{
    public function index(){
      $coupons = Coupon::all();
        return view('admin.coupon.index')->with(['coupons' => $coupons]);
    }

  public function create()
  {
    return view('admin.coupon.create');
    }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(),[
      'code' =>'required|unique:coupons|max:8|min:6',
      'value' =>'required|integer',
      'expiry' => 'required | string | max:255'
    ],
    [
      'code.required' => "Chưa nhập mã giảm giá",
      'code.unique'=>'Mã đã tồn tại',
      'code.max' => 'Độ dài mã tối đa là 8 kí tự',
      'code.min' => 'Độ dài mã ít nhất là 6 kí tự',
      'value.required' => 'Chưa nhập giá trị',
      'value.integer' => 'Yêu cầu giá trị là số nguyên',
      'expiry.required' => 'Chưa nhập ngày hết hạn'
    ]);
    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }
    $user_id = Auth()->user()->id;
    $coupon  = new Coupon;
    $coupon->user_id = $user_id;
    $coupon->code = $request->code;
    $coupon->value = $request->value;
    $coupon->expiry = $request->expiry.' 11:59:59';
    $coupon->save();
    return redirect()->route('MngCoupon.index')->with(['message'=>'Thêm thành công']);

  }

  public function edit($id)
  {
    $coupon = Coupon::find($id);
    return view('admin.coupon.edit')->with(['coupon' => $coupon]);
  }

  public function update(Request $request,Coupon $id)
  {
    $validator = Validator::make($request->all(),[
      'code' =>'required|max:8|min:6|unique:coupons',
      'value' =>'required|integer',
      'expiry' => 'required | string | max:255'
    ],
      [
        'code.required' => "Chưa nhập mã giảm giá",
        'code.max' => 'Độ dài mã tối đa là 8 kí tự',
        'code.min' => 'Độ dài mã ít nhất là 6 kí tự',
        'code.unique'=>'Mã giảm giá này đã tồn tại mời nhập lại',
        'value.required' => 'Chưa nhập giá trị',
        'value.integer' => 'Yêu cầu giá trị là số nguyên',
        'expiry.required' => 'Chưa nhập ngày hết hạn'
      ]);
    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }
    $id->code = $request->code;
    $id->value = $request->value;
    $id->expiry = $request->expiry;
    $id->save();
    return redirect()->route('MngCoupon.index')->with(['message'=>'Thêm thành công']);
  }

  public function destroy(Coupon $id)
  {
    $id->delete();
    return redirect()->back();
  }
  public function deleteAll(Request $request) {
    $coupons_id = explode(',',$request->coupon_id[0]);
    $deleted = Coupon::whereIn('id',$coupons_id)->delete();
    if($deleted) {
      return redirect()->back();
    }
    return redirect()->back();
  }
}
