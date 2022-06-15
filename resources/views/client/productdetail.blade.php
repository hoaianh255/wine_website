@extends('layouts.app')
@section('content')
<div class="product-page">
   <!-- Breadcrumb -->
   <div class="banner-page text-center col-lg-12">
    <p class="title-page Fix-moblie-ProDetail-Font">{{$product->name}}</p>
    <ul class="breadcrumb-page">
        <li><a href="{{ route('home') }}">{{__('client.HOME')}}</a></li>
        <li aria-current="page"><a href="{{ route('shop') }}">{{__('client.STORE')}}</a></li>
        <li aria-current="page">
          @foreach($product->categories as $category)
          <a class="text-capitalize" href="{{route('getProByCat',$category->slug)}}">{{$category->name}}</a>
            @if(!$loop->last)
              ,
            @endif
          @endforeach
        </li>

    </ul>
  </div>

<div class="bg-white pt-5 pb-5">
<div class="container">
<div class="row">

<div class=" col-xl-9 col-md-12 col-sm-12">
    <div class="row">
        <div class="col-xl-6 pt-4 pb-3">
            <div class="box-images-productDetail">
                <img class="rounded mx-auto d-block" style="margin-bottom: 1rem;" width="60%" height="auto" src="{{asset('storage/'.$product->thumbnail) }}" alt="">
            </div>
        </div>
        <div class="col-xl-6">

            <h2 class="pt-4 pb-3">{{$product->name}}</h2>
          @if($product->discount <= 0 || $product->discount == null)
            <h4 class="pb-3 Font-Red price-product">
              {{__('client.price')}}:
              {{$product->pricePresent('price')}}
              {{__("$")}}
            </h4>
          @else
            <h4 class="pb-3 Font-Red price-product" >
              {{__('client.price')}}:
              <span style="text-decoration: line-through !important;">{{$product->pricePresent('price')}}</span>
              <span> {{$product->pricePresent('discount')}}</span>
              {{__("$")}}
            </h4>
          @endif
          <h6 class="text-info">{{__('client.nation')}}: <a href="{{route('getProByNat',$product->nation)}}">{{$product->nation}}</a></h6>
           <div class="detail">
             {!! $product->detail !!}
           </div>

            <br><br>
          <form action="{{route('cart.store')}}" method="post" >
            <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}">
            <label for="qty">{{__('client.amount')}} :</label>
            <input name="qty" id="qty" type="number" value="1" min="0" max="10" step="1"/>
            <button  class="btn btn-danger add_product">{{__('client.buy_now')}}</button>
          </form>
          <br><br>
            <br><br>
            <p>Product ID: {{$product->codeProduct}}</p>
            <p>Categories:
              @forelse($product->categories as $category)
                <a href="{{route('getProByCat',$category->slug)}}" class="text-center text-info text-uppercase">{{$category->name}}</a>
                @if(!$loop->last)
                  ,
                @endif
              @empty
                <span class="text-center text-info">Không có danh mục</span>
              @endforelse
            </p>
            {{-- <p>Tags:
              @foreach($product->tags as $tag)
              <a href="{{route('shop.search.tag',$tag->slug)}}" class="Font-Red">{{$tag->name}}</a>
              @if(!$loop->last)
                ,
              @endif
              @endforeach
            </p> --}}

        </div>

        <div class="col-xl-12" style="margin-top: 50px;">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{__('Description')}}</a>
                  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">{{__('Additionalinformation')}}</a>
                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">{{__('Reviews')}} ({{$product->approvedComments()->count()}})</a>
                </div>
            </nav>

            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" style="width:90%;margin-left:5%">
                    <p class="Content-PDetails">
                        {!! $product->description !!}
                    </p>
                </div>

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                    <div class="box-infomation-PDetail">
                        <h4 class="mb-3">{{__('Additionalinformation')}}</h4>
                        <table class="table table-bordered">
                            <tbody>
                            <tr class="col-3">
                                <td colspan="1" class="font-weight-bold">Size</td>
                                <td colspan="2">{{$product->size}}</td>
                            </tr>
                            <tr class="col-9">
                                <td colspan="1" class="font-weight-bold">Vintage</td>
                                <td colspan="2">{{$product->vintage}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="box-infomation-PDetail">
                        <h4 class="mb-3">Reviews</h4>
                      <p>Your review *</p>
                            @comments([
                            'model' => $product,
                            'approved' => true,
                            'perPage' => 2
                            ])

                    </div>
                </div>
            </div>

        </div>
    </div>
<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 5.5em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->
  @if(count($productRelations) > 0)
    <h3 class="text-capitalize text-info">{{__('client.related_products')}}</h3><br>
  @endif
    <div class="row">
      @forelse($productRelations as $product)
        <div class="col-xl-4 col-md-4 col-sm-6 text-center productItem mb-4 Fix-product-pdd">
            <div class="productItem__content">
              <a href="{{route('shop.show',$product->slug)}}"><img class="" style="margin-bottom: 1rem;" width="100%" height="auto" src="{{asset('storage/'.$product->thumbnail) }}" alt=""></a>
              @forelse($product->categories as $category)
                <a href="{{route('getProByCat',$category->slug)}}" class="text-center text-info text-uppercase Font-Size-07vw">{{$category->name}}</a>
                @if(!$loop->last)
                  ,
                @endif
              @empty
                <span class="text-center text-info Font-Size-07vw">Không có danh mục</span>
              @endforelse
            <h4><a href="{{route('shop.show',$product->slug)}}" class="text-capitalize">{{\Illuminate\Support\Str::limit($product->name,15  )}}</a></h4>
{{--            <p>--}}
{{--                <i class="fa fa-star"></i>--}}
{{--                <i class="fa fa-star"></i>--}}
{{--                <i class="fa fa-star"></i>--}}
{{--                <i class="fa fa-star"></i>--}}
{{--                <i class="fa fa-star"></i>--}}
{{--            </p>--}}
              @if($product->discount <= 0 || $product->discount == null)
                <h6 class="pb-3 Font-Red price-product">
                  {{__('client.price')}}:
                  {{$product->pricePresent('price')}}
                  {{__("$")}}
                </h6>
              @else
                <p style="color: red; font-size: 14px" class="text-capitalize">{{__('client.promotion')}}</p>
                <h6 class="pb-3 Font-Red price-product">
                  {{__('client.price')}}:
                  {{$product->pricePresent('discount')}}
                  {{__("$")}}
                </h6>

              @endif
              <form action="{{route('cart.store')}}" method="POST">
                @csrf
                <input type="hidden" value="{{$product->id}}">
                <button  class="btn btn-danger add_product">{{__('client.buy_now')}}</button>
              </form>
        </div>
        </div>
      @empty

      @endforelse

    </div>
</div>

 @include('include.boxRightShop')
</div>
</div>
</div>
</div>
<!-- ==============End Product============ -->
@endsection
@section('script')
  <script>
    $(document).ready(function (){
      $(".add_product").click(function (e){
        e.preventDefault();

        $.ajax({
          url: "cart",
          type: "POST",
          data: {
            product_id: $('#product_id').val(),
            qty: $('#qty').val()
          }
        }).done(function (response){
          swal("Đã thêm sản phẩm " +response+ "vào giỏ hàng")
        })
      })
    })
  </script>

@endsection
@section('script')
  <script>
    ;(function($){

      /**
       * Store scroll position for and set it after reload
       *
       * @return {boolean} [loacalStorage is available]
       */
      $.fn.scrollPosReaload = function(){
        if (localStorage) {
          var posReader = localStorage["posStorage"];
          if (posReader) {
            $(window).scrollTop(posReader);
            localStorage.removeItem("posStorage");
          }
          $(this).click(function(e) {
            localStorage["posStorage"] = $(window).scrollTop();
          });

          return true;
        }

        return false;
      }

      /* ================================================== */

      $(document).ready(function() {
        // Feel free to set it for any element who trigger the reload
        $('.comment-form').scrollPosReaload();
      });

    }(jQuery));
  </script>
@endsection
