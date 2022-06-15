@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
    <section class="wrapper">
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>{{__('createuser')}}</h4>
                </div>

                <div class="card-body">
                <form method="POST" action="{{route('MngUser.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{__('name_user')}}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror "  value="{{ old('name') }}" required autocomplete="name" autofocus id="name" name="name" placeholder="{{__('entername')}}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Email')}}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="email" placeholder="{{__('enteremail')}}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{__('Password')}}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" id="password"  placeholder="{{__('enterpass')}}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">{{ __('ConfirmPassword') }}</label>
                            <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{__('enterpass')}}">
                        </div>
                    <button class="btn btn-success" type="submit">Thêm</button>
                    <a href="{{route('MngUser.index')}}" class="btn btn-secondary"><span style="color: #ffffff">{{__('cancel')}}</span></a>
                </form>
                </div>
            </div>
        </div>
    </div>
    </section>
  </section>
@endsection


