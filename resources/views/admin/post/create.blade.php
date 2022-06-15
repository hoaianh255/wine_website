@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
  <section class="wrapper">
    <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                 <h4>Thêm bài viết</h4>
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
                <form method="POST" action="{{route('MngBlog.store')}}" enctype="multipart/form-data">
                @csrf
                  <div class="form-group">
                    <label for="title">Tiêu đề *</label>
                    <input type="text" class="form-control" value="{{old('title')}}" name="title" id="title" placeholder="Nhập tên sản phẩm">
                    @error('title')
                      <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="thumbnail">Hình ảnh sản phẩm</label> <br>
                    <img src="{{ asset('storage/blog_images/noBlog.jpg') }}" id="ImagesBlog" class="img-thumbnail" alt="" width="250px"> <br><br>
                      <input type='file' id="thumbnail" value="{{old('thumbnail')}}" name="thumbnail" onchange="readURL_Images(this);"/>
                    @if($errors->has('thumbnail'))
                          <br><div class="alert alert-danger">{!! $errors->first('thumbnail') !!}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="description">Mô tả ngắn</label>
                    <textarea class="form-control" name="description" rows="3" id="description">{{old('description')}}</textarea>
                    @error('description')
                      <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="contentProduct">Nội dung</label>
                    <textarea class="form-control" name="contentProduct" id="contentProduct" rows="3">{{old('contentProduct')}}</textarea>
                    @error('content')
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
                  <div id="tags">

                  </div>
                  <button class="btn btn-success" type="submit">Thêm</button>
                  <a href="{{route('MngBlog.index')}}" class="btn btn-secondary"><span style="color: #ffffff">{{__('cancel')}}</span></a>
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
    CKEDITOR.replace('contentProduct');
    $("#categories").select2({
    placeholder: "select categories"
  })

});

function readURL_Images(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#ImagesBlog')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

</script>
@endsection
