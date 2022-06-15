@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
    <section class="wrapper">
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>Sửa Danh mục Tin tức</h4>
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
                  <form action="{{route('MngBlog.update',$blogs->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                      <label for="title">Tiêu đề *</label>
                      <input type="text" class="form-control" value="{{$blogs->title}}" name="title" id="title" placeholder="Nhập tên sản phẩm">
                    </div>

                    <div class="form-group">
                      <label for="thumbnail">Hình ảnh sản phẩm</label> <br>
                      @if($blogs->thumbnail == NULL)
                          <img src="{{ asset('storage/blog_images/noBlog.jpg') }}" id="ImagesBlog" class="img-thumbnail" width="250px"> <br><br>
                      @else
                          <img src="{{asset('storage/'.$blogs->thumbnail) }}" id="ImagesBlog" class="img-thumbnail" width="250px"> <br><br>
                      @endif
                          <input type='file' name="thumbnail" onchange="readURL_Images(this);"/>
                      @error('thumbnail')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="description">Mô tả ngắn</label>
                      <textarea class="form-control" value="{{$blogs->description}}" name="description" rows="3" id="description">{{$blogs->description}}</textarea>
                      @error('description')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="contentProduct">Nội dung</label>
                      <textarea class="form-control" value="{{$blogs->content}}" name="contentProduct" id="contentProduct" rows="3">{{$blogs->content}}</textarea>
                      @error('content')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group Limit-hetght">
                      <label for="categories">Chọn danh mục</label>
                      <select name="categories[]" id="categories" multiple class="form-control">
                        @foreach ($categories as $category)
                          <option  @if($category->checked === true) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="is_published">Hiển thị sản phẩm</label>
                      <select class="form-control" name="is_published"  id="is_published">
                          <option @if($blogs->is_published === '1') selected @endif value="1">Có</option>
                          <option @if($blogs->is_published === '0') selected @endif value="0">Không</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="especial">Đặc biệt</label>
                        <select class="form-control" name="especially" id="especial">
                            <option @if($blogs->especially === '1') selected @endif value="1">Có</option>
                            <option @if($blogs->especially === '0') selected @endif value="0">Không</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">Ngôn ngữ</label>
                        <select class="form-control" name="language_id" id="language">
                        @foreach ($languages as $language)
                            <option @if($blogs->language_id == $language->id) selected @endif value="{{$language->id}}">{{$language->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <button class="btn btn-success" type="submit">{{__('editComfin')}}</button>
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
