@extends('layouts.app')
@section('content')
<div class="container-fluid bg-white">
<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 3.5em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <h3 class="mb-3">{{__('Forgotpassword')}}</h3>
                
                <div class="mb-3">
                    <label for="email">{{__('E-Mail_Address')}}</label>
                    <input type="email" id="email" class="form-control Profile-Input Fix-high-checkout
                    @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" 
                    required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <p><span class="Font-Red font-weight-bold">{{ $message }}</span></p>
                        </span>
                    @enderror
                </div>

                <button class="btn btn-red-checkout" type="submit"><span style="font-size: 13pt">{{ __('SendPasswordResetLink') }}</span></button>
            </div>
        </div><!--/row-->
    </form>
<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 3.5em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->
</div>
@endsection