@extends('layouts.app')
@section('content')
<style>
  #Fix-BLogs img{
    width: 100% !important;
    height: auto !important;
  }
</style>
    <div class="blog-page">
        <!-- Breadcrumb -->
        <div class="banner-page text-center col-lg-12">
            <p class="title-page">{{$blog->title}}</p>
            <ul class="breadcrumb-page">
                <li><a  href="{{ route('home',app()->getLocale()) }}">{{__('HOME')}}</a></li>
                <li><a href="{{route('blog.index')}}">{{__('BLOG')}}</a></li>
            </ul>
        </div>
        <!-- Content blogger -->
      <div class="container">
          <div class="row">

              <!-- Post Content Column -->
              <div class="col-lg-9 pr-lg-5 p-1">

                <!-- Title -->
                <h1 class="mt-4">{{$blog->title}}</h1>

                <!-- Author -->
                <p class="lead">
                  {{__('by')}}
                  <a href="#">
                    {{$blog->user()->name}}
                  </a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p>{{__('Posted_on')}} {{\Carbon\Carbon::parse( $blog->day_up)->format('d/m/Y')}}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-fluid mx-auto d-block" width="100%" height="auto" src="{{asset('storage/'.$blog->thumbnail) }}" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead">{{$blog->description}}</p>

                <div id="Fix-BLogs">{!! $blog->content !!}</div>

                <hr>

              </div>

              <!-- Sidebar Widgets Column -->
              @include('include.boxRightBlog')

            </div>
            <!-- /.row -->
          </div>
      </div>
      {{-- end blogger --}}
@endsection
