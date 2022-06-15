@extends('layouts.app')
@section('content')
<div class="container-fluid bg-white">
<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 3.5em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li class="text-center">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
    <form method="POST" action="{{route('profile.update',Auth::user()->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-4 col-md-12 col-sm-12"><!--left col-->
              <div class="text-center">
                  <div class="max-height-imagess">
                    @if(Auth::user()->avatar == NULL)
                        <img src="{{ asset('images/avatar_noImg.png') }}" id="ImagesShow" class="avatar img-thumbnail" alt="avatar">
                    @else
                        <img src="{{ asset('storage/avatar_user/'.Auth::user()->avatar) }}" id="ImagesShow" class="avatar img-thumbnail" alt="avatar">
                    @endif
                  </div>
                <h6 class="pdg-images">{{__('Uploadadifferentphoto')}}</h6>
                  <input type='file' name="image" onchange="readURL_Images(this);"/>
              </div></hr><br>
              <script src="{{ asset('js/imagesShow.js') }}"></script>

              <table>
                <ul class="list-group">
                  <li class="list-group-item text-muted">{{__('Menu_profile')}}</li>
                  <li class="list-group-item text-left"><a href="{{ route('home') }}" class="text-success">{{__('HOME')}}</a></li>
                  @if (count($roles) >= 1)
                  <li class="list-group-item text-left"><a href="{{ route('dashboard.index') }}" class="Font-Red">{{__('Dashboard')}}</a></li>
                  @endif
                  <li  class="list-group-item text-left"><a class="Font-Red pull-left" href="{{ route('Logout') }}">{{__('Logout')}}</a></li>
                </ul>
              </table>
              <div class="vc_empty_space" style="height: 3.5em"><span class="vc_empty_space_inner"></span></div>
          </div>

          <div class="col-xl-8 col-md-12 col-sm-12">
                <h2 class="mb-3 text-left text-info">
                  <span class="Font-dark">{{__('infoProfile')}}</span>
                  @if (Auth::check())
                  <span class="Font-Blue">{{Auth::user()->name}}</span>
                  @else

                  @endif
                </h2>
                <div class="row">
                    <div class="col-md-12 mb-3">
                    <label for="firstName">
                      {{__('name_user')}}
                    </label>
                        <input type="text" class="form-control Profile-Input Fix-high-checkout" id="firstName" value="{{Auth::user()->name}}" name="name">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">{{__('Email')}}</label>
                    <div class="form-control Profile-Input Fix-high-checkout">
                      <h6 id="email" style="padding-top: 15px"></h6>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="Companyname">{{__('Phone')}}</label>
                    <input type="text" class="form-control Profile-Input Fix-high-checkout" id="Companyname" value="{{Auth::user()->phone}}" name="phone" >
                </div>

                <div class="mb-3">
                <label for="Companyname">{{__('address')}}</label>
                    <input type="text" class="form-control Profile-Input Fix-high-checkout" id="Companyname" value="{{Auth::user()->address}}" name="address">
                </div>

                <!-- Show ra nếu đã save thành công -->
                @if (session()->has('message'))
                <p><span class="Font-Blue font-weight-bold">{{session()->get('message')}}</span></p>
                @endif

                <button class="btn btn-red-checkout" type="submit"><span style="font-size: 13pt">{{__('Save')}}</span></button>
            </div>
        </div><!--/row-->
    </form>
<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 3.5em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        const name = "{{auth()->user()->email}}";
        const FirstName = name.slice(0,2);
        const Lastname = name.substring(name.indexOf('@'),name.length);
        $('#email').text(FirstName+"*****"+Lastname);
    })
</script>
@endsection
