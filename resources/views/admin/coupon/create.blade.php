@extends('admin.layouts.dashboard')
@section('contentAdmin')
    <section id="main-content">
      <section class="wrapper">
         <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>Thêm mã giảm giá</h4></div>
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
                        <form action="{{route('MngCoupon.store')}}" method="post">
                          @csrf
                            <div class="form-group">
                                <label for="codeCoupon">Mã giảm giá</label>
                                <input type="text" name="code" class="form-control" id="codeCoupon" placeholder="Nhập mã giảm giá">
                            </div>
                            <div class="form-group">
                              <label for="value">Giá trị</label>
                              <input type="text" class="form-control" id="value" name="value"  placeholder="Nhập giá trị">
                          </div>
                          <div class="form-group">
                            <label for="expiry">Ngày hết hạn</label>
                            <input type="text" class="form-control" id="expiry" name="expiry"  placeholder="ex: 2000/10/10">
                          </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </section>
    </section>
    <!--main content end-->
@endsection
