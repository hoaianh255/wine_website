@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
    <section class="wrapper">
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('listpro')}}</h4>
                    <form class="form-inline float-left" method="GET" action="{{route('MngProduct.search')}}">

                      <div class="form-group mx-sm-3 mb-2">

                        <input type="text" class="form-control" id="SearchRow" name="name" placeholder="...">
                      </div>
                      <button type="submit" class="btn btn-info mb-2">{{__('search')}}</button>
                    </form>

                    <a href="{{route('MngProduct.create')}}" class="btn btn-sm btn-warning float-right">{{__('addnew')}}</a>
                    <div class="form-group float-right mr-4">
                      <select class="form-control" id="orderItem" onchange="location = this.value;">
                        <option @if(isset($new)) {{$new}} @endif value="{{route('MngProduct.order','new')}}">{{__('latest')}}</option>
                        <option @if(isset($old)) {{$old}} @endif value="{{route('MngProduct.order','old')}}">{{__('oldest')}}</option>
                      </select>
                    </div>
                </div>

                <div class="card-body">
                    <form  method="POST" id="deleteAllProduct" action="{{route('MngProduct.deleteAll')}}">
                      @csrf
                      @method('delete')
                      <input type="hidden" name="productId[]">
                    </form>
                        <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" width="60">#</th>
                                <th scope="col" width="60">{{__('image')}}</th>
                                <th scope="col" width="60">{{__('name')}}</th>
                                <th scope="col" width="60">{{__('price')}}</th>
                                <th scope="col" width="60">{{__('priceSale')}}</th>
                                <th scope="col" width="100">{{__('nation')}}</th>
                                <th scope="col" width="100">{{__('catelog')}}</th>
                                <th scope="col" width="200">{{__('Especially')}}</th>
                                <th scope="col" width="200">{{__('Status')}}</th>
                                <th scope="col" width="80">{{__('view')}}</th>
                                <th scope="col" width="80">{{__('bought')}}</th>
                                <th scope="col" width="200">{{__('Datecreated')}}</th>
                                <th scope="col" width="200">{{__('Language')}}</th>
                                <th scope="col" width="129">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($products as $product)
                              <tr>
                                <td><input type="checkbox" name='Product_Id[]' value="{{$product->id}}" class="selectAllchilden"></td>
                                <td><img src="{{asset('storage/'.$product->thumbnail) }}" width="60px" alt=""></td>
                                <td><a href="{{route('shop.show',$product->slug)}}">{{ $product->name }}</a></td>
                                <td>{{number_format($product->price,0,',','.')}}</td>
                                <td>{{number_format($product->discount,0,',','.')}}</td>
                                <td>{{ $product->nation }}</td>
                                <td>

                                  @forelse($product->categories as $category)
                                  {{$category->name}}
                                  @if(!$loop->last)
                                    ,
                                  @endif
                                  @empty
                                    <span class="Font-Red">Không phân loại</span>
                                  @endforelse

                                </td>
                                <td> @if ($product->especially == 1) Có @else Không @endif</td>
                                <td>  @if ($product->is_published == 1) Đang hiển thị @else Không hiển thị @endif </td>
                                <td>{{$product->view}}</td>
                                <td>{{$product->bought}}</td>
                                <td>{{\Carbon\Carbon::parse( $product->created_at)->format('d/m/Y')}}</td>
                                <td> @if ($product->language_id == 1) Tiếng việt @else Tiếng anh @endif</td>

                                <td>
                                  <div style="display: flex;justify-content: space-between">
                                    <a href="{{route('MngProduct.edit',$product->id)}}" class="btn btn-sm btn-primary">{{__('edit')}}</a>
                                    <a href="{{route('shop.show',$product->slug)}}" class="btn btn-sm btn-warning">{{__('show')}}</a>
                                    <form action="{{route('MngProduct.destroy',$product->id)}}" method="post">
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
      {{$products->links()}}
    </div>
    </section>
  </section>
@endsection
@section('script')
<script>
    let productId = [];
  function deleteAllProduct(){
      $('input[name^="Product_Id"]').each(function() {
        if($(this).is(':checked')){
          productId.push($(this).val());
        }
      });
      $('input[name^="productId"]').val(productId)
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
