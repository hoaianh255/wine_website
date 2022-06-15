@extends('layouts.app')
@section('content')


<!--====================================== Title Cart ======================================-->
<div class="container-fluid Title_bg cart-page">
    <div>
        <div class="Display-noneX" style="height: 5.5em"><span></span></div>
        <div style="height: 5em"><span></span></div>

        <div class="checkout-bg text-center">
            <h1 class="Font-white">{{__('cart.your_cart')}}</h1>
          <ul class="breadcrumb-page">
            <li><a href="{{ route('home') }}">{{__('client.HOME')}}</a></li>
            <li aria-current="page"><a>{{__('client.cart')}}</a></li>
          </ul>
        </div>

        <div style="height: 5em"><span></span></div>
        <div class="Display-noneX" style="height: 5.8em"><span></span></div>
    </div>
</div><!-- /.sc_content -->
<!--====================================== END Title Cart ======================================-->
<div class="container-fluid bg-white">
<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 2.5em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->



<div class="px-4 px-lg-0">
    <div class="pb-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

            <!-- Shopping cart table -->

            <div class="Scroll-CartList">
                <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" class="border-0 bg-Red-I Font-white">
                        <div class="p-2 px-3 text-uppercase">{{__('cart.products')}}</div>
                        </th>
                        <th scope="col" class="border-0 bg-Red-I Font-white">
                        <div class="py-2 text-uppercase">{{__('cart.price')}}</div>
                        </th>
                        <th scope="col" class="border-0 bg-Red-I Font-white">
                        <div class="py-2 text-uppercase">{{__('cart.quantity')}}</div>
                        </th>
                        <th scope="col" class="border-0 bg-Red-I Font-white">
                        <div class="py-2 text-uppercase">{{__('cart.remove')}}</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse(Cart::content() as $item)
                    <tr>
                        <th scope="row" class="border-0">
                        <div class="p-2">
                            <img src="{{asset('storage/'.$item->model->thumbnail) }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                            <div class="ml-3 d-inline-block align-middle">
                            <h5 class="mb-0"> <a href="{{route('shop.show',$item->model->slug)}}" class="text-dark d-inline-block align-middle">{{\Illuminate\Support\Str::limit($item->name,30)}}</a></h5>
                            </div>
                        </div>
                        </th>
                        <td class="border-0 align-middle"><strong>{{$item->price(0,",",".")}}</strong></td>
                        <td class="border-0 align-middle"><strong>{{$item->qty}}</strong></td>
                        <td class="border-0 align-middle">
                          <form action="{{route('cart.destroy',$item->rowId)}}" id="delete_item" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger deleteItem text-light"><i class="fa fa-trash"></i></button>
                          </form>
                        </td>
                    </tr>
                    @empty
                     <tr>
                       <h3 class="text-center alert alert-danger">Bạn chưa mua hàng</h3>
                     </tr>
                    @endforelse
                    </tbody>
                </table>
                </div>
            </div>
            <!-- End -->
          </div>
        </div>

        <div class="row py-5 p-4 bg-white rounded shadow-sm">
          <div class="col-lg-12 mb-3">
            @if(session()->has('message-coupon'))
            <h4 class="alert-success alert text-center text-capitalize">{{session()->get('message-coupon')}}</h4>
            @endif
            @if(session()->has('error'))
                <h4 class="alert-danger alert text-center text-capitalize">{{session()->get('error')}}</h4>
            @endif
          </div>

          @if(Cart::count() > 0)
            <div class="col-lg-6">
              <div class="rounded-pill px-4 py-3 text-uppercase font-weight-bold bg-Red-I Font-white">{{__('cart.coupon_code')}}</div>
              <div class="p-4">
                <p class="font-italic mb-4">{{__('cart.if_you_have_a_coupon_code,_please_enter_it_in_the_box_below')}}</p>
                <form action="{{route('coupon.store')}}" method="post">
                  @csrf
                  <div class="input-group mb-4 border rounded-pill p-2">
                    <input type="text" placeholder="{{__('cart.apply_coupon_code')}}" name="coupon_code" aria-describedby="button-addon3" class="form-control border-0">
                    <div class="input-group-append border-0">
                      <button id="button-addon3" type="submit" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>{{__('cart.apply_coupon_code')}}</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="rounded-pill px-4 py-3 text-uppercase font-weight-bold bg-Red-I Font-white">{{__('cart.order_summary')}}</div>
              <div class="p-4">
                <ul class="list-unstyled mb-4">
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">{{__('cart.subtotal')}} </strong><strong>{{Cart::subTotal(0,',','.')." ".__('$')}}</strong></li>
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">{{__('cart.tax')}}(60%)</strong><strong>{{ Cart::tax(0,',','.')." ".__('$')}}</strong></li>
                  @if(session()->has('coupon'))
                    <li class="d-flex justify-content-between py-3 border-bottom">
                      <strong class="text-muted">{{__('cart.discount')}}({{session()->get('coupon')['name']}})
                        <form action="{{route('coupon.destroy')}}" method="post">
                          @csrf
                          @method('delete')
                          <button class="btn-sm btn-danger">{{__('cart.remove')}}</button>
                        </form>
                      </strong>
                      <strong>{{number_format($discount,0,',','.')." ".__('$')}}</strong>
                    </li>
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">{{__('cart.total')}}</strong>
                      <h5 class="font-weight-bold">{{number_format($total,0,',','.')." ".__('$')}}</h5>
                    </li>
                  @else

                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">{{__('cart.total')}}</strong>
                      <h5 class="font-weight-bold">{{Cart::total(0,',','.')." ".__('$')}}</h5>
                    </li>
                  @endif

                </ul><a href="{{route('checkout.index')}}" class="btn btn-dark rounded-pill py-2 btn-block">{{__('cart.processed_checkout_amount')}}</a>
              </div>
            </div>
          @endif


        </div>

      </div>
    </div>
  </div>



</div>



@endsection
@section('script')
  <script>
    $('.deleteItem').click(function (e) {
      e.preventDefault();
      swal({
        title: "Bạn chắc chắn chưa?",
        text: "Sau khi xóa, bạn sẽ không thể khôi phục mục này!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            swal("Mục sản phẩm của bạn đã bị xóa", {
              icon: "success",
            });
            setTimeout($('#delete_item').submit(),3000);
          } else {
            swal("Mục sản phẩm của bạn vẫn giữ nguyên");
          }
        });
    });


  </script>
@endsection
