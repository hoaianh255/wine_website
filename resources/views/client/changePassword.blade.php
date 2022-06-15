@extends('layouts.app')
@section('content')
<div class="container-fluid bg-white">
<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 3.5em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->
    <form action="">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <h3 class="mb-3">Change password</h3>
                
                <div class="mb-3">
                    <label for="Companyname">Your old password</label>
                    <input type="text" class="form-control Profile-Input Fix-high-checkout" id="Companyname" placeholder="Your old password">
                </div>
                <div class="mb-3">
                    <label for="Companyname">Your new password</label>
                    <input type="text" class="form-control Profile-Input Fix-high-checkout" id="Companyname" placeholder="Your new password">
                </div>

                <!-- Show ra nếu đã save thành công -->
                <p><span class="Font-Blue font-weight-bold">Successfully change password.</span></p>
                
                <button class="btn btn-red-checkout" type="submit"><span style="font-size: 13pt">Submit</span></button>
            </div>
            <div class="col-xl-12 col-md-12 col-sm-12"><!--left col-->
                <div class="vc_empty_space" style="height: 2.5em"><span class="vc_empty_space_inner"></span></div>
                <ul class="list-group">
                    <li class="list-group-item text-muted">Menu Profile</li>      
                    <li class="list-group-item text-right"><a href="/changePass" class="Font-Red"><span class="pull-left">Your Profile</span></a></li>
                    <li class="list-group-item text-right"><a href="/changePass" class="Font-Red"><span class="pull-left">Change password</span></a></li>
                    <li class="list-group-item text-right"><a href="/forgot" class="Font-Red"><span class="pull-left">Forgot password</span></a></li>
                </ul>  
                <div class="vc_empty_space" style="height: 3.5em"><span class="vc_empty_space_inner"></span></div>
            </div>
        </div><!--/row-->
    </form>
<!--====================================== Empty Space ======================================-->
<div class="vc_empty_space" style="height: 3.5em"><span class="vc_empty_space_inner"></span></div>
<!--====================================== END Empty Space ======================================-->
</div>
@endsection