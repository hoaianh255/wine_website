@extends('layouts.app')
@section('content')
    <div class="blog-page">
        <!-- Breadcrumb -->
        <div class="banner-page text-center col-lg-12">
          @if(isset($message))
            <p class="title-page text-capitalize">{{$message}}</p>
          @else
            <p class="title-page">{{__('client.ALL')}} {{__('client.POST')}}</p>
          @endif
            <ul class="breadcrumb-page">
                <li><a  href="{{ route('home',app()->getLocale()) }}">{{__('client.HOME')}}</a></li>
                <li aria-current="page">{{__('client.BLOG')}}</li>
            </ul>
        </div>
        <!-- Content blogger -->
        <div class="container">
            <div class="row">
                <div class="col-lg-9 pr-lg-5 p-1">
                    @foreach($blogs as $myblogs)
                        <!-- block blog -->
                        <div class="blog-block Blogs-Limit" style="display: none">
                            <div class="thumbnail-blogger">
                                <img src="{{asset('storage/'.$myblogs->thumbnail) }}" alt="">
                                <div class="mark"></div>
                                <a href="{{route('blog.show',$myblogs->slug)}}" aria-hidden="true" class="icons">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                            <div class="detail-blogger">
                                <p>{{\Carbon\Carbon::parse( $myblogs->day_up)->format('d/m/Y')}} <span>september</span></p>
                                <h1  class="title-blog"><a href="{{route('blog.show',$myblogs->slug)}}">{{\Illuminate\Support\Str::limit($myblogs->title,100  )}}</a></h1>
                                <a href="{{route('blog.show',$myblogs->slug)}}" class="learn-more">Learn more</a>
                            </div>
                        </div>
                    @endforeach
                    @if(count($blogs) > 4)
                    <div class="loadmore">
                        <button class="btn-loadMore" id="loadMore">{{__('client.Load_more')}}</button>
                    </div>
                    @elseif(count($blogs) == 0)
                        <h2 class="text-danger text-center">Nothing</h2>
                    @endif
                </div>

              @include('include.boxRightBlog')
            </div>
        </div>
    </div>
<script src="{{ asset('js/loadmore-blog.js') }}"></script>

@endsection
