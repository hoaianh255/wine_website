@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
    <section class="wrapper">
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('listorder')}}</h4>
                    <form class="form-inline float-left" method="GET" action="{{route('MngOrder.search')}}">

                      <div class="form-group mx-sm-3 mb-2">

                        <input type="text" class="form-control" id="SearchRow" name="user_name" placeholder="...">
                      </div>
                      <button type="submit" class="btn btn-info mb-2">Tìm kiếm</button>
                    </form>
                    <div class="form-group float-right mr-4">
                      <select class="form-control" id="orderItem" onchange="location = this.value;">
                        <option @if(isset($new)) {{$new}} @endif value="{{route('MngOrder.order','new')}}">{{__('latest')}}</option>
                        <option @if(isset($old)) {{$old}} @endif value="{{route('MngOrder.order','old')}}">{{__('oldest')}}</option>
                      </select>
                    </div>
                </div>

                <div class="card-body">
                  <form  method="POST" id="deleteAllProduct" action="{{route('MngOrder.deleteAll')}}">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="OrderId[]">
                  </form>
                    <table class="table table-bordered mb-0">
                        <thead>
                        <tr>
                            <th scope="col" width="50">#</th>
                            <th scope="col">{{__('name')}} {{__('user')}}</th>
                            <th scope="col" width="200">{{__('address')}}</th>
                            <th scope="col" width="400">{{__('contentbilling')}}</th>
                            <th scope="col">{{__('Email')}}</th>
                            <th scope="col">{{__('Phone')}}</th>
                            <th scope="col" width="80">{{__('Status')}}</th>
                            <th scope="col" width="80">{{__('payments')}}</th>
                            <th scope="col">{{__('CodeBill')}}</th>
                            <th scope="col">{{__('datepurchase')}}</th>
                            <th scope="col">{{__('deliverydate')}}</th>
                            <th scope="col">{{__('totally')}}</th>
                            <th scope="col">{{__('Datecreated')}}</th>
                            <th scope="col" width="80">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($orders as $order)
                            <tr>
                              <td><input type="checkbox" name='Order_Id[]' value="{{$order->id}}" class="selectAllchilden"></td>
                              <td><p>{{$order->user_name}}</p></td>
                              <td><p>{{$order->ship_address}}</p></td>
                              <td>{{$order->contentbilling}}</td>
                              <td>{{$order->ship_mail}}</td>
                              <td>{{$order->ship_phone}}</td>
                              <td> @if ($order->status == 1) <span style="font-weight:bolder;color: #d03e3b;">Đã Giao Hàng</span> @else Chưa Giao Hàng @endif </td>
                              <td> @if ($order->payment_type == 1) Thanh toán Online @else Trả tiền trực tiếp @endif </td>
                              <td>{{$order->bill}}</td>
                              <td>{{$order->day_buy}}</td>
                              <td>{{$order->day_ship}}</td>
                              <td>{{$order->total}}</td>
                              <td>{{\Carbon\Carbon::parse( $order->created_at)->format('d/m/Y')}}</td>
                              <td>
                                <div style="display: flex;justify-content: space-between">
                                  
                                  @if ($order->status == 0)
                                    <form action="{{route('MngOrder.update',$order->id)}}" method="post" enctype="multipart/form-data">
                                      @csrf
                                      @method('PATCH')
                                      <input hidden type="text" class="form-control" name="status" value="1" id="status">
                                      <button type="submit" class="btn btn-sm btn-secondary">{{__('Unshipping')}}</button>
                                    </form>
                                  @else 
                                    <form action="{{route('MngOrder.UNupdate',$order->id)}}" method="post" enctype="multipart/form-data">
                                      @csrf
                                      @method('PATCH')
                                      <input hidden type="text" class="form-control" name="status" value="0" id="status">
                                      <button type="submit" class="btn btn-sm btn-warning">{{__('shipping')}}</button>
                                    </form>
                                  @endif
                                  <form action="{{route('MngOrder.destroy',$order->id)}}" method="post">
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
                      <button style="float: right; display:none" class="btn btn-sm btn-danger sheetDelete" onclick="deleteAllProduct()" type="button">{{__('deleteselec')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="display: flex">
      {{$orders->links()}}
    </div>
    </section>
  </section>
@endsection
@section('script')
<script>
    let OrderId = [];
  function deleteAllProduct(){
      $('input[name^="Order_Id"]').each(function() {
        if($(this).is(':checked')){
          OrderId.push($(this).val());
        }
      });
      $('input[name^="OrderId"]').val(OrderId)
      $('#deleteAllProduct').submit();
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

