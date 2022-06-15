@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
    <section class="wrapper">

      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h4>{{__('coupon')}}</h4>
                      <form class="form-inline float-left">

                        <div class="form-group mx-sm-3 mb-2">

                          <input type="text" class="form-control" id="SearchRow" placeholder="Nhập giá trị cần tìm">
                        </div>
                        <button type="submit" class="btn btn-info mb-2">{{__('search')}}</button>
                      </form>

                      <a href="{{route('MngCoupon.create')}}" class="btn btn-sm btn-warning float-right">{{__('addnew')}}</a>
                      <div class="form-group float-right mr-4">
                        <select class="form-control" id="orderItem">
                          <option>Mới nhất</option>
                          <option>Cũ nhất</option>
                        </select>
                      </div>
                  </div>

                  <div class="card-body">
                      <table class="table table-bordered mb-0">
                          <thead>
                          <tr>
                              <th scope="col" width="60">#</th>
                              <th scope="col">{{__('code')}}</th>
                              <th scope="col">{{__('value')}}</th>
                              <th scope="col" width="200">{{__('Datecreated')}}</th>
                              <th scope="col" width="200">{{__('expirationdate')}}</th>
                              <th scope="col" width="129">{{__('Action')}}</th>
                          </tr>
                          </thead>
                          <tbody>
                          <form method="post" id="deleteAllCoupon" action="{{route('MngCoupon.deleteAll')}}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="coupon_id[]">
                          </form>
                          @foreach($coupons as $coupon)
                            <tr>
                                <td>
                                  <label>
                                    <input type="checkbox" name='CouponId[]' value="{{$coupon->id}}" class="selectAllChildren">
                                  </label>
                                </td>
                                <td><a href="">{{$coupon->code}}</a></td>
                                <td>
                                    {{$coupon->value ? number_format($coupon->value,0,'.',',')." vnđ" : $coupon->percent_off." %"}}
                                </td>
                                <td>{{$coupon->created_at}}</td>
                                <td>{{\Carbon\Carbon::parse($coupon->expiry)->format('d/m/Y')}}</td>

                                <td style="display: flex;justify-content: space-between">
                                    <a href="{{route('MngCoupon.edit',$coupon->id)}}" class="btn btn-sm btn-primary">{{__('edit')}}</a>
                                    <form action="{{route('MngCoupon.destroy',$coupon->id)}}"  method="post">
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
                          <button class="btn btn-sm btn-danger"  id="deleteCoupon" type="button">{{__('deleteselec')}}</button>
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

    $(document).ready(function(){
      let coupon_id = [];
      $('#deleteCoupon').on('click', function(e){
        $('input[name^="CouponId"]').each(function() {
          if($(this).is(':checked')){
            coupon_id.push($(this).val());
          }
        });
        $('input[name^="coupon_id"]').val(coupon_id)
        $('#deleteAllCoupon').submit();
      });
      $('.deleteItem').click(function (e) {
      e.preventDefault();
      var formname = $(this).parent();
      const confirmDelete = confirm("Bạn chắc chắn xóa chứ ?");
      if(confirmDelete == true){
        formname.submit();
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

