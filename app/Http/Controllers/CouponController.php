<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
      $coupon = Coupon::where('code',$request->coupon_code)->first();
      $timeCurrent = time();
      $expiry = strtotime($coupon->expiry);

        if (!$coupon){
          return redirect()->route('cart.index')->withError('Mã giảm giá không chính xác');
        }
        if(($expiry - $timeCurrent) < 0){
          return redirect()->route('cart.index')->withError('Mã giảm giá đã hết hạn');
        }
        session()->put('coupon',[
          'name'=>$coupon->code,
          'discount'=>$coupon->value,
        ]);
        return redirect()->route('cart.index')->with('message-coupon','Su dung ma giam gia thanh cong');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        session()->forget('coupon');
        return redirect()->back();
    }
}
