@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
    <section class="wrapper">
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('listuser')}}</h4>
                <form class="form-inline float-left" method="GET" action="{{route('MngUser.search')}}">
                      <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="SearchRow" name="name" placeholder="...">
                      </div>
                      <button type="submit" class="btn btn-info mb-2">{{__('search')}}</button>
                </form>
                    <a href="{{route('MngUser.create')}}" class="btn btn-sm btn-warning float-right">{{__('addnew')}}</a>
                    <div class="form-group float-right mr-4">
                      <select class="form-control" id="orderItem" onchange="location = this.value;">
                        <option @if(isset($new)) {{$new}} @endif value="{{route('MngUser.order','new')}}">{{__('latest')}}</option>
                        <option @if(isset($old)) {{$old}} @endif value="{{route('MngUser.order','old')}}">{{__('oldest')}}</option>
                      </select>
                    </div>
                </div>

                <div class="card-body">


                    <table class="table table-bordered mb-0" id="myTable">
                        <thead>
                        <tr>
                            <th scope="col" width="60">#</th>
                            <th scope="col" width="200">{{__('name')}}</th>
                            <th scope="col">{{__('Email')}}</th>
                            <th scope="col">{{__('Phone')}}</th>
                            <th scope="col">{{__('address')}}</th>
                            <th scope="col" width="129">{{__('Action')}}</th>
                        </tr>
                        </thead>

                        <tbody>
                        <form method="POST" id="deleteAllUser" action="{{route('MngUser.deleteAll')}}">
                          @csrf
                          @method('delete')
                          <input type="hidden" name="user_id[]">
                        </form>
                            @foreach ($users as $user)
                              <tr>
                              <td>
                                <label>
                                  <input type="checkbox" name='userId[]' value="{{$user->id}}" class="selectAllChildren">
                                </label>
                              </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->address}}</td>
                                <td>
                                    <div style="display: flex;justify-content: space-between">
                                        <a href="{{route('MngUser.edit',$user->id)}}" class="btn btn-sm btn-primary">{{__('edit')}}</a>
                                        <form form="deleteUser" action="{{route('MngUser.destroy',$user->id)}}" method="post">
                                          @csrf
                                          @method('delete')
                                          <button form="deleteUser" type="button" class="btn btn-sm btn-danger deleteItem">{{__('delete')}}</button>
                                        </form>
                                    </div>
                                </td>
                              </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="action mt-3">
                        <input type="checkbox" id="selectAllRow">
                        <label for="selectAllRow">{{__('selectall')}}</label>
                        <button style="float: right; display:none" class="btn btn-sm btn-danger sheetDelete" onclick="deleteAllUser()" type="button">{{__('deleteselec')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="display: flex">
      {{$users->links()}}
    </div>
    </section>
  </section>

@endsection
@section('script')
<script>
  let user_id = [];
  function deleteAllUser(){
    $('input[name^="userId"]').each(function() {
      if($(this).is(':checked')){
        user_id.push($(this).val());
      }
    });
    $('input[name^="user_id"]').val(user_id)
    $('#deleteAllUser').submit();
  }
    $(document).ready(function(){

      $('.deleteItem').click(function (e) {
        e.preventDefault();
        const formName = $(this).parent();
        console.log(formName);
        const confirmDelete = confirm("Bạn chắc chắn xóa chứ ?");
        if(confirmDelete === true){
          formName.submit();
          return true;
        }
        return false;
  });

      $('#selectAllRow').on('click', function(e) {
        if($(this).is(':checked',true))
        {
          $(".selectAllChildren").prop('checked', true);
          $(".sheetDelete").css("display", "block");
        } else {
          $(".selectAllChildren").prop('checked',false);
          $(".sheetDelete").css("display", "none");
        }
      });

      $('.selectAllChildren').on('click', function(e) {
        if($(this).is(':checked',true))
        {
          $(".sheetDelete").css("display", "block");
        } else {
          $(".sheetDelete").css("display", "none");
        }
      });

    });


</script>
@endsection

