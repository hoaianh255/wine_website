@extends('layouts.app')
@section('content')

<!--BG-WHITE-->
<div class="bg-white">
<!--BG-WHITE-->
    <!--====================================== Title Checkout ======================================-->
    <div class="container-fluid Title_bg">
        <div>
            <div class="Display-noneX" style="height: 5.5em"><span></span></div>
            <div style="height: 5em"><span></span></div>

            <div class="checkout-bg text-center">
                <h1 class="Font-white">Checkout</h1>
                <ul class="breadcrumb-List">
                    <li><a href="{{ route('home',App()->getLocale()) }}"><span>Home</span></a></li>
                    <li><span class="none-color">Checkout</span></li>
                </ul>
            </div>
            <div style="height: 5em"><span></span></div>
            <div class="Display-noneX" style="height: 5.8em"><span></span></div>
        </div>
    </div><!-- /.sc_content -->
    <!--====================================== END Title Checkout ======================================-->
    <!--====================================== Empty Space ======================================-->
    <div style="height: 7.5em"><span></span></div>
    <!--====================================== END Empty Space ======================================-->
    <!--====================================== Box-Checking ======================================-->
    <div class="container">
        <div class="row">
          @if(Route::has('login'))
            @guest
            <div class="col-12 bg-Box border-top-Box box-title">
                <p><i class="fa fa-window-maximize" aria-hidden="true"></i> {{__('Returningcustomer')}} <a href="{{route('login')}}"><span>{{__('clickheretologin')}}</span></a></p>
            </div>
            @endguest
          @endif
          @if(!session()->has('coupon'))
            <div class="col-12 bg-Box border-top-Box box-title">
                <p><i class="fa fa-window-maximize" aria-hidden="true"></i> {{__('havecoupon')}} <a href="{{route('cart.index')}}"><span>{{__('clickpoupon')}}</span></a></p>
            </div>
          @endif
        </div>
    </div>
    <!--====================================== END Box-Checking ======================================-->
    <!--====================================== Buyed ======================================-->
<div class="container">
    <div class="row">
        <div class="col-xl-12 col-md-12 col-sm-12 no-pdd-buyed">
            <form action="{{ route('checkout.create') }}" id="create_form" method="POST">
            @csrf
                <div class="col-xl-12 col-md-12 col-sm-12 no-pdd-buyed">
                    <h4 class="mb-3">{{__('checkout.Bill')}}</h4>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="firstName">{{__('checkout.name')}}</label>
                            <input type="text" class="form-control Fix-input-checkout Fix-high-checkout" 
                            name="user_name" id="user_name" placeholder="{{__('checkout.name')}}" value=" @if (Auth::check()) {{Auth::user()->name}} @else {{__('checkout.name')}}{{old('user_name')}} @endif " required>
                            @error('user_name')
                            <br><div class="alert alert-danger">{{ $errors->first('user_name') }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="Phone">{{__('checkout.address')}}</label>
                        <input type="text" class="form-control Fix-input-checkout Fix-high-checkout" 
                        name="ship_address" id="ship_address" placeholder="{{__('checkout.address')}}" value="@if (Auth::check()) {{Auth::user()->address}} @else {{__('checkout.address')}}{{old('ship_address')}} @endif" required>
                        @error('ship_address')
                        <br><div class="alert alert-danger">{{ $errors->first('ship_address') }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="Phone">{{__('checkout.phone')}}</label>
                        <input type="number" class="form-control Fix-input-checkout Fix-high-checkout" 
                        name="ship_phone" id="ship_phone" placeholder="{{__('checkout.phone')}}" value="@if (Auth::check()) {{Auth::user()->phone}} @else {{old('ship_phone')}} @endif" required>
                        @error('ship_phone')
                        <br><div class="alert alert-danger">{{ $errors->first('ship_phone') }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Emailaddress">{{__('checkout.email')}}</label>
                        <input type="email" class="form-control Fix-input-checkout Fix-high-checkout" 
                        name="ship_mail" id="ship_mail" placeholder="{{__('checkout.email')}}" value="@if (Auth::check()) {{Auth::user()->email}} @else {{old('ship_mail')}} @endif" required>
                        @error('ship_mail')
                        <br><div class="alert alert-danger">{{ $errors->first('ship_mail') }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xl-12 col-md-12 col-sm-12 no-pdd-buyed">
                    <h4 class="mb-3 Font-Blue" style="font-weight:bold">{{__('VNPay')}} <img src="{{asset('images/vnpay.jpg')}}" width="auto" height="80px" alt=""></h4>
                    <div class="form-group">
                        <select hidden name="order_type" id="order_type" class="form-control">
                            <option selected value="billpayment">Thanh toán hóa đơn</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="order_id">{{__('CodeBill')}}</label>
                        <p class="form-control Font-Red" style="font-weight:bold" id="order_id"><?php echo date("YmdHis") ?></p>
                        <input hidden class="form-control" id="order_id" name="order_id" type="text" value="<?php echo date("YmdHis") ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="amount">{{__('MoneyTotal')}}</label>
                        <p class="form-control Font-Red" style="font-weight:bold" id="amount">{{number_format($total,0,',','.')}} vnđ</p>
                        <input hidden class="form-control" id="amount"
                               name="amount"  type="number" value="{{number_format($total,0,'','')}}00"/>
                        <input hidden class="form-control" id="total" name="total" type="number" value="{{number_format($total,0,'','')}}">
                    </div>
                    <div class="form-group">
                        <label for="contentbilling">{{__('contentbilling')}}</label>
                        <textarea class="form-control" cols="20" id="contentbilling" name="contentbilling" rows="2">Không có nội dung nào.{{old('contentbilling')}}</textarea>
                    </div>
                </div>
    
                <button class="btn btn-red-checkout float-right" type="submit"><span>Place order</span></button>
            </form>
        </div>
    </div>
<!--====================================== Buyed ======================================-->
<div class="container">
    <div class="row">
        <div class="col-xl-12 col-md-12 col-sm-12 no-pdd-buyed">
            <form class="needs-validation" novalidate>    
                <hr class="mb-4">
              <h4 class="mb-3">Your order</h4>
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th scope="col" class="font-weight-bold">PRODUCT</th>
                  <th scope="col" class="font-weight-bold">TOTAL</th>
                </tr>
                </thead>
                <tbody>
                @foreach(Cart::content() as $item)
                  <tr>
                    <td colspan="1">{{$item->name}} × <span class="font-weight-bold">{{$item->qty}}</span></td>
                    <td colspan="2">{{$item->price(0,",",".")}} vnđ</td>
                  </tr>
                @endforeach
                @if($discount > 0)
                  <tr>
                    <td colspan="1" class="text-uppercase text-right font-weight-bold">DISCOUNT</td>
                    <td colspan="2" class="text-uppercase"><span class="font-weight-bold">{{number_format($discount,0,',','.')}} vnđ</span></td>
                  </tr>
                @endif
                <tr>
                  <td colspan="1" class="text-uppercase text-right font-weight-bold">SUBTOTAL</td>
                  <td colspan="2" class="text-uppercase">{{Cart::subtotal(0,',','.')}} vnđ</td>
                </tr>

                <tr>
                  <td colspan="1" class="text-uppercase text-right font-weight-bold">TAX</td>
                  <td colspan="2" class="text-uppercase"><span class="font-weight-bold">{{Cart::tax(0,',','.')}} vnđ</span></td>
                </tr>
                <tr>
                  <td colspan="1" class="text-uppercase text-right font-weight-bold">TOTAL</td>
                  <td colspan="2" class="text-uppercase"><span class="font-weight-bold Font-Red">{{number_format($total,0,',','.')}} vnđ</span></td>
                </tr>
                </tbody>
              </table>

    <hr class="mb-4">
<!--====================================== END Buyed ======================================-->
<!--====================================== Empty Space ======================================-->
<div style="height: 5.5em"><span></span></div>
<!--====================================== END Empty Space ======================================-->
<!--BG-WHITE-->
</div>
<!--BG-WHITE-->
<link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
<script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
<script type="text/javascript">
    $("#btnPopup").click(function () {
        var postData = $("#create_form").serialize();
        var submitUrl = $("#create_form").attr("action");
        $.ajax({
            type: "POST",
            url: submitUrl,
            data: postData,
            dataType: 'JSON',
            success: function (x) {
                if (x.code === '00') {
                    if (window.vnpay) {
                        vnpay.open({width: 768, height: 600, url: x.data});
                    } else {
                        location.href = x.data;
                    }
                    return false;
                } else {
                    alert(x.Message);
                }
            }
        });
        return false;
    });
</script>
@endsection
