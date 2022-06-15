@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
    <section class="wrapper">
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>Sửa sản phẩm</h4>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li class="text-center">{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div>
                @endif
                <div class="card-body">
                <form action="{{route('MngProduct.update',$product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                      <label for="name">Tên sản phẩm *</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$product->name}}" placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="codeProduct">Mã sản phẩm</label>
                        <input type="text" class="form-control" name="codeProduct" id="codeProduct" value="{{$product->codeProduct}}" placeholder="Nhập Mã sản  phẩm">
                      </div>
                    <div class="form-group">
                        <label for="size">Kích cỡ</label>
                        <input type="text" class="form-control" name="size" value="{{$product->size}}" id="size" placeholder="Nhập kích cỡ">
                    </div>
                    <div class="form-group">
                        <label for="vintage">Năm sản xuất</label>
                        <input type="text" class="form-control" name="vintage" value="{{$product->vintage}}" id="vintage" placeholder="Nhập kích cỡ">
                    </div>
                    <div class="form-group">
                        <label for="detail">Mô tả</label>
                        <textarea name="detail" id="detail" class="form-control" rows="3">{{$product->detail}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Hình ảnh sản phẩm</label> <br>
                    @if($product->thumbnail == NULL)
                        <img src="{{ asset('images/noImg.jpg') }}" id="ImagesProduct" class="img-thumbnail" width="250px"> <br><br>
                    @else
                        <img src="{{asset('storage/'.$product->thumbnail) }}" id="ImagesProduct" class="img-thumbnail" width="250px"> <br><br>
                    @endif
                        <input type='file' name="thumbnail" onchange="readURL_Images(this);"/>
                    @error('thumbnail')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Giá *</label>
                        <input type="number" name="price" class="form-control" value="{{$product->price}}" id="price" placeholder="Nhập giá sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="discount">Giá giảm</label>
                        <input type="number" name="discount" class="form-control" value="{{$product->discount}}" id="discount" placeholder="Nhập giá giảm sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="nation">Quốc gia *</label>
                        <input type="text" class="form-control" name="nation" value="{{$product->nation}}" id="nation" placeholder="Nhập quốc gia">
                    </div>
                    <div class="form-group">
                        <label for="amount">Số lượng *</label>
                        <input type="number" class="form-control" name="amount" value="{{$product->amount}}" id="amount" placeholder="Nhập số lượng sản phẩm">
                    </div>
                    <div class="form-group">
                       <select name="categories[]" id="categories" multiple class="form-control">
                           @foreach ($categories as $category)
                                <option  @if($category->checked === true) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                           @endforeach
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Giới thiệu sản phẩm</label>
                        <textarea rows="40" class="form-control" name="description" id="description" rows="5">{{$product->description}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="is_published">Hiển thị sản phẩm</label>
                        <select class="form-control" name="is_published"  id="is_published">
                            <option @if($product->is_published === '1') selected @endif value="1">Có</option>
                            <option @if($product->is_published === '0') selected @endif value="0">Không</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="especial">Đặc biệt</label>
                        <select class="form-control" name="especially" id="especial">
                            <option @if($product->especially === '1') selected @endif value="1">Có</option>
                            <option @if($product->especially === '0') selected @endif value="0">Không</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">Ngôn ngữ</label>
                        <select class="form-control" name="language_id" id="especial">
                         @foreach ($languages as $language)
                          <option @if($product->language_id == $language->id) selected @endif value="{{$language->id}}">{{$language->name}}</option>
                         @endforeach
                        </select>
                    </div>
                    <button class="btn btn-success" type="submit">{{__('editComfin')}}</button>
                    <a href="{{route('MngProduct.index')}}" class="btn btn-secondary"><span style="color: #ffffff">{{__('cancel')}}</span></a>
                  </form>
                </div>
            </div>
        </div>
    </div>
    </section>
  </section>
@endsection
@section('script')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>

  $(document).ready(function() {
    CKEDITOR.replace('description');
    $("#categories").select2({
    placeholder: "select categories"
  })

});
    function readURL_Images(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#ImagesProduct')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

