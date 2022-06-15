@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
    <section class="wrapper">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h4>{{__('articlecomment')}}</h4>

                  </div>

                  <div class="card-body">
                      <table class="table table-bordered mb-0">
                          <thead>
                          <tr>
                              <th scope="col" width="60">#</th>
                              <th scope="col">{{__('user')}}</th>
                              <th scope="col">{{__('Content')}}</th>
                              <th scope="col">{{__('product')}}</th>
                              <th scope="col" width="200">{{__('Datecreated')}}</th>
                              <th scope="col">{{__('display')}}</th>
                              <th scope="col" width="129">{{__('Action')}}</th>
                          </tr>
                          </thead>
                          <tbody>
                          <form method="POST" id="deleteAllComment" action="{{route('MngComment.deleteAll')}}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="comment_id[]">
                          </form>
                          @foreach($comments as $comment)
                            <tr>
                              <td>
                                  <label>
                                    <input type="checkbox" name='commentId[]' value="{{$comment->id}}" class="selectAllChildren">
                                  </label>
                              </td>
                              <td>{{$comment->commenter->email}}</td>
                              <td>
                                  {{$comment->comment}}
                              </td>
                              <td><a href="{{route('shop.show',$comment->commentable->slug)}}">{{$comment->commentable->name}}</a></td>
                              <td>{{\Carbon\Carbon::parse($comment->created_at)->format('H:i:s d/m/Y')}}</td>
                              <td>
                                <form action="{{route('MngComment.approved',$comment->id)}}" method="post">
                                  @method('patch')
                                  @csrf
                                  <label>
                                    <input @if($comment->approved === true) checked @endif  onchange="this.form.submit()" type="checkbox">
                                  </label>
                                </form>
                              </td>
                              <td style="display: flex;justify-content: space-between">
                                 <form action="{{route('MngComment.delete',$comment->id)}}"  method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-sm btn-danger deleteItem">{{__('delete')}}</button>
                                  </form>
                              </td>
                            </tr>
                          @endforeach
                          </tbody>
                      </table>
                      <div class="action mt-3">
                        <input type="checkbox" id="selectAllRow">
                        <label for="selectAllRow">{{__('selectall')}}</label>

                        <form class="float-right" action="">
                          <input type="hidden">
                          <button class="btn btn-sm btn-danger" onclick="deleteAllComment()" type="button">{{__('deleteselec')}}</button>
                        </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
  </section>
@endsection
@section('script')
<script>
  let user_id = [];
  function deleteAllComment(){
      $('input[name^="commentId"]').each(function() {
        if($(this).is(':checked')){
          user_id.push($(this).val());
        }
      });
      $('input[name^="comment_id"]').val(user_id)
      $('#deleteAllComment').submit();
    }
    $(document).ready(function(){
      $('.deleteItem').click(function (e) {
      e.preventDefault();
      let formName = $(this).parent();
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

