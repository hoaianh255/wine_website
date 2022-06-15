@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
  <section class="wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('tags')}}</h4>
                    <form class="form-inline float-left" method="GET" action="{{route('MngTags.search')}}">

                      <div class="form-group mx-sm-3 mb-2">

                        <input type="text" class="form-control" id="SearchRow" name="name" placeholder="...">
                      </div>
                      <button type="submit" class="btn btn-info mb-2">{{__('search')}}</button>
                    </form>
                     
                    <a href="{{route('MngTags.create')}}" class="btn btn-sm btn-warning float-right">{{__('addnew')}}</a>
                    <div class="form-group float-right mr-4">
                      <select class="form-control" id="orderItem" onchange="location = this.value;">
                        <option @if(isset($new)) {{$new}} @endif value="{{route('MngTags.order','new')}}">{{__('latest')}}</option>
                        <option @if(isset($old)) {{$old}} @endif value="{{route('MngTags.order','old')}}">{{__('oldest')}}</option>
                      </select>
                    </div>
                </div>

                <div class="card-body">
                  <form  method="POST" id="deleteAllTags" action="{{route('MngTags.deleteAll')}}">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="TagId[]">
                  </form>
                  <table class="table table-bordered mb-0">
                      <thead>
                      <tr>
                          <th scope="col" width="60">#</th>
                          <th scope="col">{{__('name')}}</th>
                          <th scope="col">{{__('Status')}} Primary</th>
                          <th scope="col" width="200">{{__('Datecreated')}}</th>
                          <th scope="col" width="200">{{__('Language')}}</th>
                          <th scope="col" width="129">{{__('Action')}}</th>
                      </tr>
                      </thead>
                      <tbody>

                        @foreach ($tags as $tag)
                          <tr>
                              <td><input type="checkbox" name='TagId[]' value="{{$tag->id}}" class="selectAllchilden"></td>
                              <td><a href="#">{{$tag->name}}</a></td>
                              <td>  @if ($tag->primary == 1) Đang hiển thị @else Không hiển thị @endif </td>
                              <td>{{\Carbon\Carbon::parse( $tag->created_at)->format('d/m/Y')}}</td>
                              <td> @if ($tag->language_id == 1) Tiếng việt @else Tiếng anh @endif</td>
                              <td>
                                <div style="display: flex;justify-content: space-between">
                                  <a href="{{route('MngTags.edit',$tag->id)}}" class="btn btn-sm btn-primary">{{__('edit')}}</a>
                                  <form action="{{route('MngTags.destroy',$tag->id)}}" method="post">
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
                    <button style="float: right; display:none" class="btn btn-sm btn-danger sheetDelete" onclick="deleteAllTags()" type="button">{{__('deleteselec')}}</button>
                  </div>
              </div>

            </div>
        </div>
    </div>
    <div class="col-md-12" style="display: flex">
      {{$tags->links()}}
    </div>
  </section>
</section>
@endsection
@section('script')
<script>
    let TagId = [];
    function deleteAllTags(){
      $('input[name^="TagId"]').each(function() {
        if($(this).is(':checked')){
          TagId.push($(this).val());
        }
      });
      $('input[name^="TagId"]').val(TagId)
      $('#deleteAllTags').submit();
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

