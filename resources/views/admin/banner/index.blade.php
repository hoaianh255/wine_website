@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
  <section class="wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h4>{{__('Banner')}}</h4>
                  <form class="form-inline float-left" method="GET" action="{{route('MngBanner.search')}}">

                        <div class="form-group mx-sm-3 mb-2">

                          <input type="text" class="form-control" id="SearchRow" name="name" placeholder="...">
                        </div>
                        <button type="submit" class="btn btn-info mb-2">{{__('search')}}</button>
                  </form>

                      <a href="{{route('MngBanner.create')}}" class="btn btn-sm btn-warning float-right">{{__('addnew')}}</a>
                      <div class="form-group float-right mr-4">
                        <select class="form-control" id="orderItem" onchange="location = this.value;">
                          <option @if(isset($new)) {{$new}} @endif value="{{route('MngBanner.order','new')}}">{{__('latest')}}</option>
                          <option @if(isset($old)) {{$old}} @endif value="{{route('MngBanner.order','old')}}">{{__('oldest')}}</option>
                        </select>
                      </div>
                </div>

                <div class="card-body">
                  <form  method="POST" id="deleteAllBanner" action="{{route('MngBanner.deleteAll')}}">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="BannerId[]">
                  </form>
                    <table class="table table-bordered mb-0">
                        <thead>
                        <tr>
                            <th scope="col" width="60">#</th>
                            <th scope="col">{{__('image')}}</th>
                            <th scope="col">{{__('name')}}</th>
                            <th scope="col">{{__('title')}}</th>
                            <th scope="col">{{__('link')}}</th>
                            <th scope="col">{{__('location')}}</th>
                            <th scope="col">{{__('Language')}}</th>
                            <th scope="col" width="200">{{__('Datecreated')}}</th>
                            <th scope="col" width="129">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                
                      @foreach ($banner as $banners)
                        <tr>
                          <td><input type="checkbox" name='Banner_Id[]' value="{{$banners->id}}" class="selectAllchilden"></td>
                          <td><img src="{{asset('storage/'.$banners->thumbnail) }}" width="100px" alt=""></td>
                          <td><a href="">{{$banners->name}}</a></td>
                          <td>{{$banners->description}}</td>
                          <td>{{$banners->link}}</td>
                          <td>{{$banners->order}}</td>
                          <td> @if ($banners->language_id == 1) Tiếng việt @else Tiếng anh @endif</td>
                          <td>{{\Carbon\Carbon::parse( $banners->created_at)->format('d/m/Y')}}</td>
                          
                          <td>
                            <div style="display: flex;justify-content: space-between">
                              <a href="{{route('MngBanner.edit',$banners->id)}}" class="btn btn-sm btn-primary">{{__('edit')}}</a>
                              <form action="{{route('MngBanner.destroy',$banners->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-sm btn-danger deleteItem">{{__('delete')}}</button>
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
                      <button style="float: right; display:none" class="btn btn-sm btn-danger sheetDelete" onclick="deleteAllBanner()" type="button">{{__('deleteselec')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="display: flex">
      {{$banner->links()}}
    </div>
  </section>
</section>
@endsection
@section('script')
<script>
    let BannerId = [];
    function deleteAllBanner(){
      $('input[name^="Banner_Id"]').each(function() {
        if($(this).is(':checked')){
          BannerId.push($(this).val());
        }
      });
      $('input[name^="BannerId"]').val(BannerId)
      $('#deleteAllBanner').submit();
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
          $(".selectAllchilden").prop('checked', true);  
          $(".sheetDelete").css("display", "block");;
        } else {  
          $(".selectAllchilden").prop('checked',false);  
          $(".sheetDelete").css("display", "none");;
        }  
      });

      $('.selectAllchilden').on('click', function(e) {
        if($(this).is(':checked',true))  
        {
          $(".sheetDelete").css("display", "block");;
        } else {  
          $(".sheetDelete").css("display", "none");;
        }  
      });

    });


</script>
@endsection

