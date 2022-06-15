@extends('admin.layouts.dashboard')
@section('contentAdmin')
<section id="main-content">
    <section class="wrapper">
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>Thêm Tags</h4>                           
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
                  <form method="POST" action="{{route('MngTags.store')}}" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                      <label for="name">Tên Tags</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name" placeholder="Nhập tên Tags">
                      @error('name')
                          <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="primary">Hiển thị Tags</label>
                      <select class="form-control" name="primary"  id="primary">
                        <option value="1">Có</option>
                        <option value="0">Không</option>
                      </select>
                      @error('primary')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <button class="btn btn-success" type="submit">Thêm</button>
                    <a href="{{route('MngTags.index')}}" class="btn btn-secondary"><span style="color: #ffffff">{{__('cancel')}}</span></a>
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
</script>
@endsection
