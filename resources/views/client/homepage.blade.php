@extends('layouts.app')

@section('content')

<!--====================================== SLIDE SHOW ======================================-->
<div id="carouselIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators carousel-indicators-Fix">
    <li class="carousel-items active" data-target="#carouselIndicators" data-slide-to="0"></li>
    <li class="carousel-items" data-target="#carouselIndicators" data-slide-to="1"></li>
    <li class="carousel-items" data-target="#carouselIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        
        @foreach ($banner as $banners)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <a href="{{$banners->link}}">
                    <img class="d-block w-100" src="{{asset('storage/'.$banners->thumbnail) }}" alt="First slide">
                    <div class="carousel-caption d-none d-md-block FIX-Carousel-Caption">
                        <h1 style="padding-bottom: 10px;" class="Font-Yellow text-left carousel-SlideShow Forum">{{$banners->name}}</h1>
                        <p class="Font-dark text-left Edit-Font-Size-SlideShow"><span class="Font-Yellow" style="font-size:15pt">{{$banners->description}}</span></p>
                    </div>
                </a>
            </div>    
        @endforeach
    
    </div>
</div>
<!--====================================== END SLIDE SHOW ======================================-->
<div class="container">  <!-- Dang Lam Viec -->
{{--<!--====================================== Empty Space ======================================-->--}}
{{--<div class="vc_empty_space" style="height: 8.4em"><span class="vc_empty_space_inner"></span></div>--}}
{{--<!--====================================== END Empty Space ======================================-->--}}
<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 8.4em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->
<!--====================================== Recommendations ======================================-->
<div class="container">
<div class="row">
    <div class="col-sm-12 my-auto">
        <h6 class="text-center Font-Red item_subtitle text-capitalize">{{__('client.Our_product')}}</h6>
        <h1 class="text-center text-capitalize">{{__('client.Preferred_Products')}}</h1>
        <div class="text-center item_descr">{{__('client.info_company')}}</div>
    </div>
</div>
</div>
<!--====================================== END Recommendations ======================================-->
<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 3.5em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->
<!--====================================== Product preferred list ======================================-->
<div class="container bg-white">
<div class="row">
    <div class="MultiCarousel" data-items="1,2,3,4" data-slide="1" id="MultiCarousel"  data-interval="1000">
        <div class="MultiCarousel-inner">
            @forelse($productsEsp as $product)
            <div class="item">
                <div class="bg-white" style="position: relative;">
                    <a href="">
                        <div class="circle-box text-center">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                    </a>
                    <a href="{{route('shop.show',$product->slug)}}">
                        <img class="" style="margin-bottom: 1rem;" width="auto" height="250px" src="{{asset('storage/'.$product->thumbnail) }}" alt="">
                    </a> <br>
                    @forelse($product->categories as $category)
                    <a href="{{route('getProByCat',$category->slug)}}" class="text-center text-info text-uppercase ">{{$category->name}}</a>
                        @if(!$loop->last)
                            ,
                        @endif
                    @empty
                        <span class="text-center text-info ">Không có danh mục</span>
                    @endforelse
                        <div class="col-12 mx-auto" style="padding: 20px;">
                        <a class="Hover-Red" href="{{route('shop.show',$product->slug)}}"><h5 class="Font-Blue" style="height: 50px;transition: 0.3s;">{{\Illuminate\Support\Str::limit($product->name,15  )}}</h5></a>
                          @if($product->discount <= 0 || $product->discount == null)
                            <h5 class="p-3 Font-Red">
                              {{__('client.price')}}:
                              {{$product->pricePresent('price')}}
                              {{__("$")}}
                            </h5>
                          @else
                            <p style="color: red; font-size: 14px">{{__('client.promotion')}}</p>
                            <h5 class="p-3 Font-Red">
                              {{__('client.price')}}:
                              {{$product->pricePresent('discount')}}
                              {{__("$")}}
                            </h5>
                          @endif
                    </div>
                </div>
            </div>
            @empty
            <h5>Thêm sản phẩm để hiển thị ở đây</h5>
            @endforelse


        </div>
        <div class="btn btn-white-Op-50 leftLst"><i class="fa fa-arrow-left" aria-hidden="true"></i></div>
        <div class="btn btn-white-Op-50 rightLst"><i class="fa fa-arrow-right" aria-hidden="true"></i></div>
    </div>
</div>

</div>
    <div class="row">
        <div class="col-md-12 text-center">
            <br/><br/><br/>
            <hr/>
        </div>
    </div>
<script src="{{ asset('js/Multi-Item-Carousel.js') }}"></script>
<!--====================================== END CATALOG LIST ======================================-->
<!--====================================== Recommendations 2 ======================================-->
<div class="container">
    <div class="row">
        <div class="col-sm-12 my-auto">
            <h1 class="text-center fixed-font-size-h1">{{__('client.Recommendations')}}</h1>

        </div>
    </div>
</div>
<!--====================================== END Recommendations 2 ======================================-->
<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 3.5em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->

<!--====================================== Product preferred list 2 ======================================-->
<div class="container bg-white">
    <div class="row">
        <div class="MultiCarousel" data-items="1,2,3,4" data-slide="1" id="MultiCarousel"  data-interval="1000">
            <div class="MultiCarousel-inner">
                @forelse($productsRec as $product)
                <div class="item">
                    <div class="bg-white" style="position: relative;">
                        <a href="">
                            <div class="circle-box text-center">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </div>
                        </a>
                        <a href="{{route('shop.show',$product->slug)}}">
                            <img class="text-center" style="margin-bottom: 1rem;" width="auto" height="250px" src="{{asset('storage/'.$product->thumbnail) }}" alt="">
                        </a> <br>
                        @forelse($product->categories as $category)
                        <a href="{{route('getProByCat',$category->slug)}}" class="text-center text-info text-uppercase ">{{$category->name}}</a>
                            @if(!$loop->last)
                                ,
                            @endif
                        @empty
                            <span class="text-center text-info ">Không có danh mục</span>
                        @endforelse
                            <div class="col-12 mx-auto" style="padding: 20px;">
                            <a class="Hover-Red" href="{{route('shop.show',$product->slug)}}"><h5 class="Font-Blue" style="height: 50px;transition: 0.3s;">{{\Illuminate\Support\Str::limit($product->name,15  )}}</h5></a>
                              @if($product->discount <= 0 || $product->discount == null)
                                <h5 class="p-3 Font-Red">
                                  {{__('client.price')}}:
                                  {{$product->pricePresent('price')}}
                                  {{__("$")}}
                                </h5>
                              @else
                                <p style="color: red; font-size: 14px">{{__('client.promotion')}}</p>
                                <h5 class="p-3 Font-Red">
                                  {{__('client.price')}}:
                                  {{$product->pricePresent('discount')}}
                                  {{__("$")}}
                                </h5>
                              @endif
                        </div>
                    </div>
                </div>
                @empty
                <h5>Thêm sản phẩm để hiển thị ở đây</h5>
                @endforelse
    
    
            </div>
            <div class="btn btn-white-Op-50 leftLst"><i class="fa fa-arrow-left" aria-hidden="true"></i></div>
            <div class="btn btn-white-Op-50 rightLst"><i class="fa fa-arrow-right" aria-hidden="true"></i></div>
        </div>
    </div>
    
    </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <br/><br/><br/>
                <hr/>
            </div>
        </div>
    <script src="{{ asset('js/Multi-Item-Carousel.js') }}"></script>
    <!--====================================== END CATALOG LIST ======================================-->

<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 10.34em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->
<!--====================================== Carousel with Multiple Items ======================================-->
<div class="container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row bg-white">
                    <h1 class="col-md-12 text-center mt-5 text-capitalize">{{__('client.Title_posts_especially')}}</h1>
                    @foreach($blogs_esp as $blog)
                    <div class="col-xl-4 col-md-12 col-sm-12 nopadding bg-white glowing-moblie">
                        <div class="blogger_padding_text blogger_classic">
                            <div class="vc_empty_space" style="height: 2.8em"><span class="vc_empty_space_inner"></span></div>
                            <div id="" class="">
                                <a href="{{route('blog.show',$blog->slug)}}">
                                    <div style="max-height: 220px;overflow:auto" class="No-scroll-overflow">
                                        <img src="{{asset('storage/'.$blog->thumbnail) }}" width="100%" height="auto"  alt="">
                                    </div>
                                </a>
                                <a href="#">
                                    <span class="day" style="font-size: 30px">{{\Carbon\Carbon::parse($blog->created_at)->format('d')}}</span> <span class="Font-dark">{{\Carbon\Carbon::parse($blog->created_at)->format('M')}}</span>
                                </a>
                                <h5 class="sc_item_title" style="margin-top: 30px;"><a class="text-danger" href="{{route('blog.show',$blog->slug)}}">{{\Illuminate\Support\Str::limit($blog->title,30)}}</a></h5>

                            </div>
                            <div class="vc_empty_space" style="height: 3.2em"><span class="vc_empty_space_inner"></span></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

</div>
<!--====================================== END Carousel with Multiple Items ======================================-->
<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 9.7em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->
<!--====================================== Contact find US in Google ======================================-->
<div class="container-fluid bg-white">
    <div class="row">
        <div class="col-xl-6 col-md-6 col-sm-12 nopadding bg-purple " style="overflow: hidden;">
            <img style="right: 0;width: 110%;position: relative;" src="{{ asset('images/contact.jpg') }}" alt="">
            <div class="contact-home">

                <div style="padding-left: 80px;padding-right: 5rem;padding-top: 3rem;">
                    <h1 class=" color_subtitle text-capitalize">{{__('client.get_it_touch')}}</h1>
                    <div class="item_descr3 Font-Yellow2" style="width: auto;">{{__('client.info_company')}}</div>
                    <div class="item_descr2 Font-Yellow2" style="width: auto;">{{__('client.address')}}: Phần Mềm Quang Trung Cơ Sở 3 FPT Polytechnic</div>
                    <div class="item_descr2 Font-Yellow2" style="width: auto;">Phone: <a href=""><span class="Font-Red">+84 943 355 123</span></a></div>
                    <div class="mr-subtitle Display-None2">
                        <a href=""class="btn-subtitle-contact Display-None4" style="float: left;">{{__('client.get_it_touch')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 col-sm-12 nopadding with-high-moblie">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2770.76689176222!2d106.62898165919992!3d10.852871199767703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529e76ef4ac4d%3A0x30d6a9932e802efe!2sFPT%20Polytechnic%20HCM%20-%20C%C6%A1%20s%E1%BB%9F%203!5e0!3m2!1svi!2s!4v1601211056224!5m2!1svi!2s"
            width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
</div>
<!--====================================== END Contact find US in Google ======================================-->
@endsection
