@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
    <section class="wrapper">
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>Thêm sản phẩm</h4>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                  <form method="POST" action="{{route('MngProduct.store')}}" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                      <label for="name">Tên sản phẩm *</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name" placeholder="Nhập tên sản phẩm">
                      @error('name')
                          <br><div class="alert alert-danger">{{ $errors->first('name') }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="codePro">Mã sản phẩm *</label>
                      <input type="text" class="form-control" name="codePro" value="{{old('codePro')}}" id="codePro" placeholder="Nhập mã sản phẩm">
                      @error('codePro')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="size">Kích cỡ</label>
                      <input type="text" class="form-control" name="size" value="{{old('size')}}" id="size" placeholder="Nhập kích cỡ">
                      @error('size')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="vintage">Năm sản xuất</label>
                      <input type="text" class="form-control" name="vintage" value="{{old('vintage')}}" id="vintage" placeholder="Nhập kích cỡ">
                      @error('vintage')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="detail">Mô tả</label>
                      <textarea name="detail" id="details" class="form-control" rows="3">{{old('detail')}}</textarea>
                      @error('detail')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="thumbnail">Hình ảnh sản phẩm</label> <br>
                    <img src="{{ asset('storage/product_images/noImg.jpg') }}" id="ImagesProduct" class="img-thumbnail" alt="" width="250px"> <br><br>
                      <input type='file' id="thumbnail" value="" name="thumbnail" onchange="readURL_Images(this);"/>
                    @if($errors->has('thumbnail'))
                          <br><div class="alert alert-danger">{!! $errors->first('thumbnail') !!}</div>
                    @endif
                    </div>

                    <div class="form-group">
                      <label for="price">Giá *</label>
                      <input type="number" name="price" class="form-control" value="{{old('price')}}" id="price" placeholder="Nhập giá sản phẩm">
                      @error('price')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="discount">Giá giảm</label>
                      <input type="number" name="discount" class="form-control" value="{{old('discount')}}" id="discount" placeholder="Nhập giá giảm sản phẩm">
                      @error('discount')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="nation">Quốc gia *</label>
                      <input type="text" class="form-control" name="nation" value="{{old('nation')}}" id="nation" placeholder="Nhập quốc gia">
                      @error('nation')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="amount">Số lượng *</label>
                      <input type="number" class="form-control" name="amount" value="{{old('amount')}}" id="amount" placeholder="Nhập số lượng sản phẩm">
                      @error('amount')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="categories">Chọn danh mục *</label>

                      <select id="categories" name="categories[]"  class="form-control" multiple="multiple">
                        @foreach ($categories as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                        @error('categories')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="description">Giới thiệu sản phẩm</label>
                      <textarea class="form-control" name="description" id="description" rows="5">{{old('description')}}</textarea>
                      @error('description')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="is_published">Hiển thị sản phẩm</label>
                      <select class="form-control" name="is_published"  id="is_published">
                        <option value="1">Có</option>
                        <option value="0">Không</option>
                      </select>
                      @error('is_published')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="especial">Đặc biệt</label>
                      <select class="form-control" name="especially" id="especial">
                        <option value="1">Có</option>
                        <option value="0">Không</option>
                      </select>
                      @error('especially')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="language">Ngôn ngữ</label>
                      <select class="form-control" name="language_id" id="language_id">
                       @foreach ($languages as $language)
                        <option value="{{$language->id}}">{{$language->name}}</option>
                       @endforeach
                      </select>
                      @error('language_id')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <button class="btn btn-success" type="submit">Thêm</button>
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
  $("#Tags").select2({
    placeholder: "select Tags"
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
