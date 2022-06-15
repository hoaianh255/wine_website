@extends('admin.layouts.dashboard')
@section('contentAdmin')
  <section id="main-content">
      <section class="wrapper">
        <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                     <h4>{{__('edituser')}}</h4>
                  </div>
                    @if(session()->has('message'))
                      {{session()->get('message')}}
                    @endif
                  <div class="card-body">
                    <form action="{{route('MngUser.update',$user->id)}}" method="post">
                      @csrf
                      @method('PATCH')
                      <div class="form-group">
                        <label for="nameProduct">{{__('name_user')}}</label>
                        <input type="text" class="form-control" id="nameProduct" name="name" value="{{$user->name}}" placeholder="{{__('entername')}}">
                      </div>
                      <div class="form-group">
                        <label for="nameProduct">{{__('Email')}}</label>
                       <h5 class="form-control">{{$user->email}}</h5>
                      </div>
                      <div class="form-group">
                        <label for="nameProduct">{{__('Phone')}}</label>
                        <input type="number" value="{{$user->phone}}" class="form-control" name="phone" id="nameProduct" placeholder="{{__('enterphone')}}">
                      </div>
                      <div class="form-group">
                        <label for="nameProduct">{{__('address')}}</label>
                        <input type="text" value="{{$user->address}}" class="form-control" name="address" id="nameProduct" placeholder="{{__('enteraddress')}}">
                      </div>

                      <div class="form-group">
                        <label for="roles">{{__('choose')}} {{__('Administration')}}</label>
                        <br>
                          @foreach($roles as $role)
                          <label for="{{$role->id}}">
                            <input type="checkbox" id="{{$role->id}}" name="roles[]" @if($role->checked === true) checked @endif value="{{$role->id}}"> {{$role->name}}
                          </label>
                          <br>
                          @endforeach
                      </div>

                      <button class="btn btn-success" type="submit">{{__('editComfin')}}</button>
                      <a href="{{route('MngUser.index')}}" class="btn btn-secondary"><span style="color: #ffffff">{{__('cancel')}}</span></a>
                    </form>
                  </div>
              </div>
          </div>
      </div>
      </section>
    </section>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        const name = "{{auth()->user()->email}}";
        const FirstName = name.slice(0,2);
        const Lastname = name.substring(name.indexOf('@'),name.length);
        $('#email').text(FirstName+"*****"+Lastname);
        // $('#email').text = ;


    })
</script>
@endsection

