@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
    <section class="wrapper">
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('listorder')}} {{__('details')}}</h4>
                    <form class="form-inline float-left" method="GET" action="{{route('MngOrderDetail.search')}}">

                      <div class="form-group mx-sm-3 mb-2">

                        <input type="text" class="form-control" id="SearchRow" name="product_name" placeholder="...">
                      </div>
                      <button type="submit" class="btn btn-info mb-2">Tìm kiếm</button>
                    </form>
                    <div class="form-group float-right mr-4">
                      <select class="form-control" id="orderItem" onchange="location = this.value;">
                        <option @if(isset($new)) {{$new}} @endif value="{{route('MngOrderDetail.order','new')}}">{{__('latest')}}</option>
                        <option @if(isset($old)) {{$old}} @endif value="{{route('MngOrderDetail.order','old')}}">{{__('oldest')}}</option>
                      </select>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered mb-0">
                        <thead>
                        <tr>
                            <th scope="col" width="60">#</th>
                            <th scope="col">{{__('procode')}}</th>
                            <th scope="col">{{__('proname')}}</th>
                            <th scope="col">{{__('price')}}</th>
                            <th scope="col">{{__('quantity')}}</th>
                            <th scope="col">{{__('Datecreated')}}</th>
                        </tr>
                        </thead>

                        <tbody>
                          @foreach ($orderdetails as $orderdetail)
                            <tr>
                              <td>{{$orderNumber++}}</td>
                              <td>{{$orderdetail->product_code}}</td>
                              <td>{{$orderdetail->product_name}}</td>
                              <td>{{$orderdetail->price}}</td>
                              <td>{{$orderdetail->quantity}}</td>
                              <td>{{\Carbon\Carbon::parse( $orderdetail->created_at)->format('d/m/Y')}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="display: flex">
      {{$orderdetails->links()}}
    </div>
    </section>
  </section>
@endsection
