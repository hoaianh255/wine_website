@extends('layouts.app')
@section('content')
<div class="product-page">
   <!-- Breadcrumb -->
   <div class="banner-page text-center col-lg-12">
    <p class="title-page text-capitalize Fix-moblie-ProDetail-Font">
      @if(isset($message))
        {{$message}}
      @else
        {{__('client.all_products')}}
      @endif
    </p>
    <ul class="breadcrumb-page">
        <li><a href="{{ route('home',app()->getLocale()) }}">{{__('client.HOME')}}</a></li>
        <li aria-current="page">{{__('client.STORE')}}</li>
    </ul>
  </div>


<!-- ==============Product============ -->
<div class="bg-white pt-5 pb-5">
<div class="container">
<div class="row">
  <div class=" col-xl-9 col-md-12 col-sm-12">
    <div class="row" style="align-items: stretch">
    @foreach($products  as $product)
      <div class="col-xl-4 col-md-6 col-6 text-center productItem mb-4 Fix-product-pdd">
        <div class="productItem__content" style="height: 100%">
          <a href="{{route('shop.show',$product->slug)}}"> 
            <div id="hiddenScroll" class="Fix-moblie-img-Shop-max-height" style="max-height: 250px;overflow: hidden;">
              <img style="margin-bottom: 1rem;" class="Fix-moblie-img-Shop" width="auto" height="250px" src="{{asset('storage/'.$product->thumbnail) }}" alt="">
            </div>
          </a> <br>
          @forelse($product->categories as $category)
            <a href="{{route('getProByCat',$category->slug)}}" class="text-capitalize">{{$category->name}}</a>
            @if(!$loop->last)
              ,
            @endif
          @empty
            <a href="#">Không phân loại</a>
          @endforelse
          <h4><a class="text-danger" href="{{route('shop.show',$product->slug)}}">{{\Illuminate\Support\Str::limit($product->name,14)}}</a></h4>
          <p>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </p>
          @if($product->pricePresent('discount') != 0 && $product->pricePresent('discount') != null )
            <p class="text-danger text-center text-capitalize">{{__('client.promotion')}}</p>
            <h4 style="color: #da3f19; ;">
            {{$product->pricePresent('discount')}}
              {{__('client.$')}}
            </h4>
          @else
            <h4 style="color: #da3f19; ;">
              {{$product->pricePresent('price')}}
              {{__('client.$')}}
            </h4>
          @endif
      </div>
      </div>
      @endforeach

      <div class="col-md-12" style="display: flex;justify-content: center">
        {{$products->links()}}
      </div>
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
        let arr = [];
        $.ajax({
          url: "/shop/getProducts",
          type: "get"
        }).done(function (response){
          arr.push(response);
        })
      console.log(arr);
    })
  </script>
@endsection
