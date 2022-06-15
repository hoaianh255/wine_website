<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="{{ asset('') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Quanlity Wine') }}</title>
    <link rel="icon" href="{{ asset('images/icon-website.png') }}">
    
  <script type="application/x-javascript">
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <!-- fonts -->
  <link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
<!--================================================================================================================================================================================================================================-->
    <!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <!-- CSS JS Style -->
    <link rel="stylesheet" href="{{ asset('css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('css/product.css')}}">
    <link rel="stylesheet" href="{{ asset('css/fontello.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
  <!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <!-- Font Awesome (Icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!--================================================================================================================================================================================================================================-->
</head>
<body>

<!--====================================== scrollTopOP ======================================-->
<button onclick="scrollTopOP()" id="myBtnScrollTop" title="Go to top" style="display: none;"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>

<!--====================================== END scrollTopOP ======================================-->

<!--====================================== HEADER ======================================-->
    <header class="section-header padding-Header bg-white">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-xl-3 col-md-3 col-sm-12 Display-NoneCalls">
            <div class="card card-border-0 flex-row align-items-center h-100">
                    <a href="" class="text-dark edit-icon mr-auto-moblie-icon" style="padding: 10px 15px;border: 2px solid #bdb68e"><i class="fa fa-phone" aria-hidden="true"></i></a>
                <div class="card-block px-2">
                    <p class="card-text Re-font-ms"><span class="font-weight-bold Font-Blue">{{__('client.Call_us')}}: <a href="tel:123-456-7890" class="Font-Blue">@if(isset($info)) {{$info->phone}}@endif</a></span>
                    <br>
                    <a class="Font-Blue" href="mailto:QuanlityWine@gmail.com">@if(isset($info)) {{$info->email}}@endif</a></p>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 col-sm-12">
            <a href="{{route('home')}}"><img class="rounded mx-auto d-block" src="{{ asset('images/logo.png') }}" alt=""></a>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-12 space_moblie2">
            <div class="card card-border-0 flex-row align-items-center h-100">
{{--                <div class="">--}}
                    <a href="{{route('cart.index')}}" class="text-dark edit-icon mr-auto-moblie-icon" style="padding: 10px 15px;border: 2px solid #bdb68e"> <i class="fa fa-shopping-bag" aria-hidden="true"></i></a>
{{--                </div>--}}
            <div class="mr-auto-moblie btn cart-open">
                <div class="card-block px-2">
                    <p class="card-text Re-font-ms text-cart-center"><span class="font-weight-bold Font-Blue">{{__('client.Your_cart')}}:</span> <br> <span class="Font-Yellow">{{Cart::count()}} item(s) </span></p>
                </div>
            </div>
            </div>

            <div class="Cart-list ml-auto">
                <!-- <p class="No-products">No products in the cart.</p> -->
                <div class="box-cart-overflow">
                  @forelse(Cart::content() as $item)
                    <div class="card card-border-0 flex-row align-items-center h-100" style="margin-top: 20px;margin-left: 10px;">
                        <div class="card-header bg-products-cart">
                            <img src="{{asset('storage/'.$item->model->thumbnail) }}" alt="" width="40px">
                        </div>
                        <div class="card-block px-2">
                            <p class="card-text Re-font-ms" style="width: 100%;"><span style="font-size: 15px;"><a href="" class="Font-Blue">{{\Illuminate\Support\Str::limit($item->name,20)}}</a></span></p>
                                <p class="Font-Red font-weight-bold">{{number_format($item->price)." ".__('client.$')." x ".$item->qty}}</p>
                        </div>
                    </div>
                    <br><hr class="hr-cart-Products">
                  @empty
                  @endforelse
                </div>

                <p class="font-weight-bold" style="padding: 20px 0px 0 5%;">Subtotal: <span class="Font-Red">{{(Cart::subtotal())." ".__('$')}}</span></p>
                <div class="subtotal">
                    <a href="{{route('cart.index')}}" class="btn-subtitle-cart" style="margin-left: 5%;"><span class="">View cart</span></a>
                <a href="{{ route('checkout.index') }}" class="btn-subtitle-cart" style="margin-left: 2%;"><span class="">Checkout</span></a>
                </div>
            </div>
            <script>
                /*CART*/
                $(document).ready(function(){
            
                $(".cart-open").click(function(){
                $(".Cart-list").toggleClass("active").focus();
                });
            
                });
                /* END CART*/
            </script>
        </div>
        </div>
    </div>
    </header>
<!--====================================== END HEADER ======================================-->

<!--====================================== MENU ======================================-->
    <nav class="navbar navbar-expand-lg sticky-top bg-white">
        <div class="container">
            <button class="navbar-toggler mx-auto" type="button" id="btnMenuDropdown">
                <i class="fa fa-bars Font-Yellow" aria-hidden="true"></i>
            </button>
            <div class="collapse navbar-collapse navbar-collapse-custome">
                <ul class="nav navbar-nav navbar-logo mx-auto Blue-Link position-Re">
                    <li class="nav-item"> <a class="nav-link text-uppercase padding-text Font-Size-1vw" href="{{ route('home') }}">{{__('client.HOME')}}</a> </li>
                    <li class="nav-item"><a class="nav-link text-uppercase padding-text Font-Size-1vw" href="{{ route('shop') }}">{{__('client.STORE')}}</a></li>
                    <li class="nav-item"><a class="nav-link text-uppercase padding-text Font-Size-1vw" href="{{ route('blog.index') }}">{{__('client.BLOG')}}</a></li>
                    <li class="nav-item"><a class="nav-link text-uppercase padding-text Font-Size-1vw" href="{{ route('contact') }}">{{__('client.CONTACT')}}</a></li>
                    @if(Route::has('login'))
                        @auth
                <li class="nav-item"><a class="nav-link text-uppercase padding-text Font-Size-1vw" href="{{route('profile.edit')}}">{{__('profile')}}</a></li>
                        @else
                        <li class="nav-item"><a class="nav-link text-uppercase padding-text Font-Size-1vw" href="{{ route('login') }}">{{__('client.LOGIN')}}</a></li>
                            @if (Route::has('register'))
                                 <li class="nav-item"><a class="nav-link text-uppercase padding-text Font-Size-1vw" href="{{ route('register') }}">{{__('client.REGISTER')}}</a>
                            @endif
                        @endif
                    @endif
                    <li class="nav-item" style="margin-top: 5px">
                      <select name="select_language" id="select_language">
                            @foreach($languages as $language)
                                <option value="{{route('setLanguage',$language->slug)}}"
                                    @if(App()->getLocale() == $language->slug)
                                        selected
                                    @endif

                                >{{$language->slug}}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
            </div> <!-- navbar-collapse.// -->
        </div><!-- container //  -->
    </nav>
    <div id="mySidenav" class="sidenav-Moblie">
        <ul class="navbar-nav">
            <li class="nav-item">
                <div class="nav-link">
                    <i class="fa fa-window-close btn icon-close-menu" style="font-size: 30px;" id="btnCloseMenu" aria-hidden="true">X</i>
                </div>
                @if(Route::has('login'))
                @auth
                <li class="nav-item"><a class="nav-link padding-text Font-white" style="margin-bottom: -15px" href="{{route('profile.edit')}}">{{__('profile')}}</li>
                @else
                <li class="nav-item"><a class="nav-link padding-text Font-white" href="{{ route('login') }}">{{__('client.LOGIN')}}</a></li>
                @if (Route::has('register'))
                <li class="nav-item"><a class="nav-link padding-text Font-white" href="{{ route('register') }}">{{__('client.REGISTER')}}</a>
                @endif
                @endif
                @endif
            </li></li>
            <li class="nav-item" style="margin-top: 5px">
                <a class="nav-link Font-white" style="float: left;margin-right:20px;margin-left:15px" href="{{route('setLanguage','en')}}"><span class="@if(App()->getLocale() == 'en') Font-Red @else Font-white @endif">English</span></a>
                <a class="nav-link Font-white" style="float: left"  href="{{route('setLanguage','vn')}}"><span class="@if(App()->getLocale() == 'vn') Font-Red @else Font-white @endif">Việt Nam</span></a>
            </li>
        </ul>
        <div class="box-menu-scroll">
            <div id="scrollMenu">
                <ul class="nav navbar-nav navbar-logo mx-auto Moblie-Fonts-Menu position-Re">
                    <li class="nav-item"><a class="nav-link padding-text" href="{{ route('home') }}">{{__('client.HOME')}}</a> </li>
                    <li class="nav-item"><a class="nav-link padding-text" href="{{ route('shop') }}">{{__('client.STORE')}}</a></li>
                    <li class="nav-item"><a class="nav-link padding-text" href="{{ route('blog.index') }}">{{__('client.BLOG')}}</a></li>
                    <li class="nav-item"><a class="nav-link padding-text" href="{{ route('contact') }}">{{__('client.CONTACT')}}</a></li>
                </ul>
            </div>
        </div>

    </div>
    <div class="vc_empty_space bg-white" style="padding: 0 0 4.1em;"><span class="vc_empty_space_inner"></span></div>
<script>
$(document).ready(function(){
  $("#btnMenuDropdown").click(function(){
    $(".sidenav-Moblie").toggleClass("active");
    $(".sidenav-Moblie").removeClass("icon-close-menu");
  });
  $("#btnCloseMenu").click(function(){
    $(".sidenav-Moblie").removeClass("active");
    $(".sidenav-Moblie").addClass("icon-close-menu");
  });
});
</script>
<!--====================================== END MENU ======================================-->

<!--====================================== MAIN ======================================-->
    <main>
        <div class="bg-white">
        @yield('content')
        </div>
    </main>
<!--====================================== END MAIN ======================================-->

<!--====================================== FOOTER ======================================-->
<footer class="section-header padding-Header bg-white">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-xl-3 col-md-3 col-sm-12 Display-None">
            <div class="card card-border-0 flex-row align-items-center h-100">

                <div class="card-block px-2">
                    <p class="card-text Re-font-ms"><span class="Font-dark Font-Size-07vw">@if(isset($info)) {{$info->address}}@endif</span></p>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 col-sm-12">
            <a href="{{route('home')}}"><img class="rounded mx-auto d-block" src="{{ asset('images/logo.png') }}" alt=""></a>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-12 Display-None">
            <div class="card card-border-0 flex-row align-items-center h-100">
                <a href="" class="text-dark edit-icon mr-auto-moblie-icon" style="margin-right: 20px;padding: 10px 15px;border: 2px solid #bdb68e">
                    <i class="fa fa-globe Font-dark" aria-hidden="true"></i>
                </a>
                <a href="" class="text-dark edit-icon mr-auto-moblie-icon" style="margin-right: 20px;padding: 10px 15px;border: 2px solid #bdb68e">
                    <i class="fa fa-github Font-dark" aria-hidden="true"></i>
                </a>
                <a href="" class="text-dark edit-icon mr-auto-moblie-icon" style="padding: 10px 15px;border: 2px solid #bdb68e">
                    <i class="fa fa-linkedin-square Font-dark" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="text-center show-in-moblie" style="display: none;">
          <p class="card-text Re-font-ms Fix-moblie-footer-Font" style="padding-top:30px;"><span class="Font-dark"></span>@if(isset($info)) {{$info->address}}@endif</p>
        </div>
        </div>
    </div>
</footer>
<!--====================================== END FOOTER ======================================-->

<script>
    $(document).ready(function (){
        $('#select_language').change(function (){
            var selectedLanguage = $(this).children("option:selected").val();
            window.location.replace(selectedLanguage);
        });

    });
</script>
<script src="{{ asset('js/Scrollstop.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
@yield('script')

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v9.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="108725027554252"
  theme_color="#fa3c4c"
  logged_in_greeting="Chào! Làm thế nào chúng tôi có thể giúp bạn?"
  logged_out_greeting="Chào! Làm thế nào chúng tôi có thể giúp bạn?">
</div>

</body>
</html>
