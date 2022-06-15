<div class="col-lg-3 d-none d-lg-block p-1">
    <div class="search" style="margin-bottom: 100px;">
      <h5 style="margin-bottom: 40px;">{{__('client.search')}}</h5>
      <form method="POST" action="{{route('blog.search')}}" class="form-search">
        @csrf
          <input type="text" name="searching" placeholder="Search...">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
    <div class="recent-post" style="margin-bottom: 50px;">
        <h5 style="margin-bottom: 40px;">{{__('Recent_Posts')}}</h5>

        @foreach($blogsRecent as $myblogs)
        <div class="block-recent-post">
            <div class="recent-post-thumb">
                <a href="{{route('blog.show',$myblogs->slug)}}">
                    <div style="max-height: 80px;overflow:auto" class="No-scroll-overflow">
                        <img src="{{asset('storage/'.$myblogs->thumbnail) }}" width="100%" height="auto"  alt="">
                    </div>
                </a>
            </div>
            <div class="recent-post-content px-3">
                <h6 class="recent-post-title">
                    <a href="{{route('blog.show',$myblogs->slug)}}">{{$myblogs->title}}{{$myblogs->id}}{{\Illuminate\Support\Str::limit($myblogs->title,5  )}}</a>
                </h6>
                <div class="post-info">
                    <p style="color: #BDB68E;font-size: 13px;">{{\Carbon\Carbon::parse( $myblogs->day_up)->format('d/m/Y')}}</p>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <div class="categories" style="margin-bottom: 100px;">
        <h5 style="margin-bottom: 40px;">{{__('catelog')}}</h5>
        <ul class="categories-menu">
            @foreach($categoriesBlog as $CateBlog)
            <li class="cat-item"><i class="demo-icon icon-wine"></i><a class="text-capitalize" href="{{route('blog.search.categories',$CateBlog->slug)}}">{{$CateBlog->name}}</a></li>
            @endforeach
        </ul>
    </div>
    {{-- <div class="tags" style="margin-bottom: 100px;">
        <h5 style="margin-bottom: 40px;">Tags</h5>
        <div class="tagclound">
          @foreach($tagPrimary as $tag)
            <a href="{{route('blog.search.tag',$tag->slug)}}">{{$tag->name}}</a>
          @endforeach
        </div>
    </div> --}}
</div>
