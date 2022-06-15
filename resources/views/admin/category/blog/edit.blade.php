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
                  <form action="{{route('MngCateLogBlog.update',$categoryBlog->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                      <label for="name">Tên Danh mục Tin tức</label>
                    <input type="text" class="form-control" name="name" value="{{$categoryBlog->name}}" id="name" placeholder="Nhập tên Danh mục Tin tức">
                      @error('name')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="type">Danh mục thuộc về</label>
                      <select class="form-control" name="type"  id="type">
                        <option value="{{$categoryBlog->type}}" selected>Danh mục Tin tức</option>
                      </select>
                      @error('type')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="is_published">Hiển thị sản phẩm</label>
                      <select class="form-control" name="is_published"  id="is_published">
                        <option @if($categoryBlog->is_published === '1') selected @endif value="1">Có</option>
                        <option @if($categoryBlog->is_published === '0') selected @endif value="0">Không</option>
                      </select>
                      @error('is_published')
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
                    <button class="btn btn-success" type="submit">{{__('editComfin')}}</button>
                    <a href="{{route('MngCateLogBlog.index')}}" class="btn btn-secondary"><span style="color: #ffffff">{{__('cancel')}}</span></a>
                  </form>
                </div>
            </div>
        </div>
    </div>
    </section>
  </section>
@endsection
@section('script')
@endsection
