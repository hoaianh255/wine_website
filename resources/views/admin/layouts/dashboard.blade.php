<!DOCTYPE html>
<html lang="en">

<head>
  <base href="{{ asset('') }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Quanlity Wine') }}</title>
  <link rel="icon" href="{{ asset('images/icon-website.png') }}">
  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <script src="https://kit.fontawesome.com/7da7bccd11.js" crossorigin="anonymous"></script>

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/styleADmin.css')}}" rel="stylesheet">
  <link href="{{ asset('css/style-responsive.css')}}" rel="stylesheet">




  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>


</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="{{ route('home') }}" class="logo"><b>Brand <span>Genuine Wine</span></b></a>
      <!--logo end-->
      
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="{{ route('Logout') }}">{{__('Logout')}}</a></li>
          <li class="nav-item" style="margin-top: 15px">
            <a class="nav-link Font-white" style="float: left;margin-right:20px;margin-left:15px" href="{{route('setLanguage','en')}}"><span class="@if(App()->getLocale() == 'en') Font-Yellow2 @else Font-white @endif">English</span></a>
            <a class="nav-link Font-white" style="float: left"  href="{{route('setLanguage','vn')}}"><span class="@if(App()->getLocale() == 'vn') Font-Red2 @else Font-white @endif">Việt Nam</span></a>
          </li>
        </ul>

      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse" style="z-index: 10">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered">
            <a href="{{route('profile.edit',Auth::user()->id)}}">
              @if(Auth::user()->avatar == NULL)
                  <img src="{{ asset('images/avatar_noImg.png') }}" id="ImagesShow" class="avatar img-thumbnail" alt="avatar">
              @else
                  <img src="{{ asset('storage/avatar_user/'.Auth::user()->avatar) }}" id="ImagesShow" class="avatar img-thumbnail" alt="avatar">
              @endif
            </a>
          </p>
          <h5 class="centered">{{Auth::user()->name}}</h5>
          <li class="mt">
              <a  href="{{route('dashboard.index')}}">
                <i class="fa fa-dashboard"></i>
                <span>{{__('dashboard')}}</span>
              </a>
          </li>
          <li class="sub-menu"><!-- CATELOG -->
            <a href="javascript:" class="EffectActive">
             <i class="fas fa-book-open"></i>
              <span>{{__('catelog')}}</span>
              </a>
            <ul class="sub">
              <li><a href="{{route ('MngCateLogProDuct.index')}}">{{__('catelogproduct')}}</a></li>
              <li><a href="{{route ('MngCateLogBlog.index')}}">{{__('catelogblog')}}</a></li>
            </ul>
          </li>
          {{-- <li><!-- PRODUCTS -->
            <a href="{{route ('MngTags.index')}}">
              <i class="fa fa-tags" aria-hidden="true"></i>
              <span>{{__('tags')}}</span>
            </a>
          </li> --}}
          <li><!-- PRODUCTS -->
            <a href="{{route ('MngProduct.index')}}">
              <i class="fas fa-wine-bottle"></i>
              <span>{{__('product')}}</span>
            </a>
          </li>
          <li>
            <a href="{{route ('MngBlog.index')}}">
              <i class="far fa-newspaper"></i>
              <span>{{__('BLOG')}}</span>
            </a>
          </li>
          <li>
            <a href="{{route ('MngCoupon.index')}}">
              <i class="fa fa-ticket" aria-hidden="true"></i>
              <span>{{__('coupon')}}</span>
            </a>
          </li>
          <li>
            <a href="{{route ('MngComment.index')}}">
              <i class="fas fa-comment"></i>
              <span>{{__('comment')}}</span>
            </a>
          </li>
          <li>
            <a href="{{route ('MngBanner.index')}}">
              <i class="fa fa-picture-o" aria-hidden="true"></i>
              <span>{{__('Banner')}}</span>
            </a>
          </li>
          <li>
            <a href="{{route ('MngUser.index')}}">
              <i class="fa fa-users"></i>
              <span>{{__('account')}}</span>
            </a>
          </li>
          <li class="sub-menu"><!-- ORDERS -->
            <a href="javascript:;">
              <i class="fas fa-file-invoice-dollar"></i>
              <span>{{__('order')}}</span>
              </a>
            <ul class="sub">
              <li><a href="{{route ('MngOrder.index')}}">{{__('order')}}</a></li>
              <li><a href="{{route ('MngOrderDetail.index')}}">{{__('orderDetail')}}</a></li>
            </ul>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
      @yield('contentAdmin')
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Brand Genuine Wine</strong>. All Rights Reserved
        </p>
        <div class="credits">

        </div>
        <a href="index.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="{{ mix('js/app.js') }}"></script>


  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <script type="text/javascript" src="lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script src="lib/sparkline-chart.js"></script>
  <script src="lib/zabuto_calendar.js"></script>
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

  <script type="application/x-javascript">
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }

    $(document).ready(function () {
    $('li .EffectActive').click(function(e) {

        $('li EffectActive.active').removeClass('active');

        var $parent = $(this).parent();
        $parent.addClass('active');
        e.preventDefault();
    });
    });

  </script>
  @yield('script')
</body>

</html>
