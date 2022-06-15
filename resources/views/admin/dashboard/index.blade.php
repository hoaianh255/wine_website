@extends('admin.layouts.dashboard')
@section('contentAdmin')
<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <div class="py-3 row">
       <div class="col-md-4 Padding-For-Moblie">
        <div class="block-statistical">
          <img src="{{ asset('images/IconImages/icon-bg.jpg') }}" width="100%" height="auto" alt="" style="overflow: hidden;">
          <div class="link-to-category">
            <img src="{{ asset('images/IconImages/wine-glass.png') }}" width="10%" alt="" style="z-index: 1000">
            <a href="{{route ('MngProduct.index')}}">{{__('totally')}} {{$productsCount}} {{__('product')}}</a>
          </div>
        </div>
       </div>
       <div class="col-md-4">
        <div class="block-statistical">
          <img src="{{ asset('images/IconImages/icon-bg.jpg') }}" width="100%" height="auto" alt="" style="overflow: hidden;">
          <div class="link-to-category">
            <img src="{{ asset('images/IconImages/box.png') }}" width="10%" alt="" style="z-index: 1000">         
            <a href="{{route ('MngOrder.index')}}">{{$ordersCount}} {{__('order')}}</a>
          </div>
        </div>
       </div>
       <div class="col-md-4">
        <div class="block-statistical">
          <img src="{{ asset('images/IconImages/icon-bg.jpg') }}" width="100%" height="auto" alt="" style="overflow: hidden;">
          <div class="link-to-category">
            <img src="{{ asset('images/IconImages/account.png') }}" width="10%" alt="" style="z-index: 1000">
            <a href="{{route ('MngUser.index')}}">{{$usersCount}} {{__('accountuser')}}</a>
          </div>
        </div>
       </div>
    </div>

    <div class="py-3 row">
      <div class="col-md-4">
       <div class="block-statistical">
         <img src="{{ asset('images/IconImages/icon-bg.jpg') }}" width="100%" height="auto" alt="" style="overflow: hidden;">
         <div class="link-to-category">
          <img src="{{ asset('images/IconImages/blog.png') }}" width="10%" alt="" style="z-index: 1000">             
           <a href="{{route ('MngBlog.index')}}">{{__('totally')}} {{$blogsCount}} {{__('BLOG')}}</a>
         </div>
       </div>
      </div>
      <div class="col-md-4">
       <div class="block-statistical">
         <img src="{{ asset('images/IconImages/icon-bg.jpg') }}" width="100%" height="auto" alt="" style="overflow: hidden;">
         <div class="link-to-category">
          <img src="{{ asset('images/IconImages/comment.png') }}" width="10%" alt="" style="z-index: 1000">         
           <a href="{{route ('MngComment.index')}}">{{$reviewsCount}} {{__('reviews')}}</a>
         </div>
       </div>
      </div>
      <div class="col-md-4">
       <div class="block-statistical">
         <img src="{{ asset('images/IconImages/icon-bg.jpg') }}" width="100%" height="auto" alt="" style="overflow: hidden;">
         <div class="link-to-category">
          <img src="{{ asset('images/IconImages/catelog.png') }}" width="10%" alt="" style="z-index: 1000">
         <a href="{{ route ('dashboard.index') }}">{{$categoriesCount}} {{__('catelog')}}</a>
         </div>
       </div>
      </div>
   </div>

    <hr style=" height: 1px;
    background-color: #e84393;
    border: none;">
    <div class="row">       
      <div class="col-md-6">
        <div class="rank-post">
            <h3 class="mb-5" style="border-bottom:3px solid #00b894">{{__('topposts')}}</h3>
            <div class="ScrollListPosts">
              @foreach ($blogViews as $Rblogs)
                <div class="block-rank-post">
                  <h4 class="title"><a href="{{route('blog.show',$Rblogs->slug)}}"><span class="Font-Red">{{$Rblogs->title}}</span></a>
                  </h4>
                  <i class="mr-4">{{\Carbon\Carbon::parse( $Rblogs->day_up)->format('d/m/Y')}}</i>
                  <i class="fas fa-eye"></i> {{$Rblogs->view}}
                </div>  
              @endforeach   
            </div>         
        </div>
      </div>
      <div class="col-md-6">
        <div class="total-income" >
          <h3 class="mb-5" style="border-bottom:3px solid #ff7675">{{__('allmoney')}}</h3>
          <div class="ScrollListPosts">
            @foreach ($orders as $order)
              <div class="block-rank-post">
                <h4 class="title Font-Red" style="margin-bottom: 20px"> <i class="fa fa-user-circle" aria-hidden="true"></i> <span class="Font-Yellow">{{$order->user_name}}</span></h4>
                <div style="max-height: 80px;overflow:auto;margin-bottom: 20px">
                  <p>
                    <span class="mr-4"><i class="fa fa-commenting" style="color: #d03e3b;" aria-hidden="true"></i> {{$order->contentbilling}}</span>
                  </p>
                </div>
                <p style="margin-bottom: 20px"><i class="fa fa-shopping-bag" style="color: #d03e3b;" aria-hidden="true"></i> @if ($order->payment_type == 1) <span style="font-weight:bold" class="Font-Green"> Thanh toán Online </span> @else <span style="font-weight:bold" class="Font-Font-purple2"> Trả tiền trực tiếp </span> @endif</p>
                <h5 style="margin-bottom: 20px"><i class="fa fa-truck" style="color: #d03e3b;" aria-hidden="true"></i> @if ($order->status == 1) <span style="font-weight:bolder;color: #d03e3b;">Đã Giao Hàng <i class="fa fa-check" style="padding-left:10px" aria-hidden="true"></i></span> @else Chưa Giao Hàng @endif </h5>
              </div>  
            @endforeach   
          </div>     
      </div>
      </div>
    </div>
  </section>
</section>
<!--main content end-->    
@endsection