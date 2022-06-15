@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
    <section class="wrapper">
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>Thêm Banner</h4>                           
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
                  <form method="POST" action="{{route('MngBanner.store')}}" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                      <label for="name">Tên Banner</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name" placeholder="Nhập tên Banner">
                      @error('name')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Phần giới thiệu</label>
                        <textarea class="form-control" name="description" id="description" rows="5">{{old('description')}}</textarea>
                        @error('description')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Hình ảnh Banner</label> <br>
                        <img src="{{ asset('images/noBanner.jpg') }}" id="ImagesProduct" class="img-thumbnail" alt="" width="450px"> <br><br>
                        <input type='file' id="thumbnail" value="" name="thumbnail" onchange="readURL_Images(this);"/>
                        @if($errors->has('thumbnail'))
                              <br><div class="alert alert-danger">{!! $errors->first('thumbnail') !!}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="link">Link Banner (ra URL lấy)</label>
                      <input type="text" class="form-control" name="link" value="{{old('link')}}" id="link" placeholder="Nhập link Banner">
                        @error('link')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="order">Vị trí</label>
                      <input type="number" class="form-control" name="order" value="{{old('order')}}" id="order" placeholder="Nhập vị trí Banner">
                        @error('link')
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
                    <a href="{{route('MngBanner.index')}}" class="btn btn-secondary"><span style="color: #ffffff">{{__('cancel')}}</span></a>
                  </form>
                </div>
            </div>
        </div>
    </div>
    </section>
  </section>
@endsection
@section('script')
<script>

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
