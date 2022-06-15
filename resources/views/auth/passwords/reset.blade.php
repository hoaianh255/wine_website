@extends('layouts.app')
@section('content')
<div class="container-fluid bg-white">
<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 3.5em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <h3 class="mb-3">{{__('Reset_Password')}}</h3>
                
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label for="email">{{__('E-Mail_Address')}}</label>
                    <input id="email" type="email" class="form-control Profile-Input Fix-high-checkout 
                    @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" 
                    required autocomplete="email" autofocus>
                
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password">{{__('Password')}}</label>
                    <input id="password" type="password" class="form-control Profile-Input Fix-high-checkout
                    @error('password') is-invalid @enderror" name="password"
                    required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="password-confirm">{{__('Confirm_Password')}}</label>
                    <input id="password-confirm" type="password" class="form-control Profile-Input Fix-high-checkout" 
                    name="password_confirmation" required autocomplete="new-password">
                </div>

                <button class="btn btn-red-checkout" type="submit"><span style="font-size: 13pt">{{__('Reset_Password')}}</span></button>
            </div>
        </div><!--/row-->
    </form>

<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 3.5em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->
</div>
@endsection