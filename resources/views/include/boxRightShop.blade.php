<div class="col-xl-3 col-md-12 col-sm-12 px-3">
  <div class="row productCategories">
    <div class="col-xl-12 col-md-6 col-sm-12">
      <div class="search" style="margin-bottom: 50px;">
        <h5 style="margin-bottom: 40px;">{{__('client.search')}}</h5>
        <form method="GET" action="{{route('shop.searchByName')}}" class="form-search">

            <input type="text" name="searching" placeholder="Search...">

          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>
      <h4 class="pt-4 pb-3 text-capitalize">{{__('client.product_categories')}}</h4>
      <div class="productCategories__list pl-2 mb-5">
        @foreach($categories as $category)
          <a href="{{route('getProByCat',$category->slug)}}"  class="text-capitalize"><i class="fa fa-angle-right"></i>  {{$category->name}}</a>
        @endforeach
      </div>
    </div>
    <div class="col-xl-12 col-md-6 col-sm-12">
      <h4 class="pt-4 pb-3 text-capitalize">{{__('client.filterProduct')}}</h4>
      <form action="{{route('shop.filters')}}" method="get">
        <div class="form-group boxSelect">
          <label for="sortby">Sắp xếp theo</label>
          <select class="form-control" name="sortBy" id="sortBy">
            <option value="">Sắp xếp theo</option>
            <option {{old("sortBy") == "desc" ? "selected" : ""}} value="desc">Mới nhất</option>
            <option {{old("sortBy") =="asc" ? "selected" : ""}}  value ="asc" >Cũ nhất</option>
          </select>
        </div>
        <div class="form-group boxSelect">
          <label for="vintage">Năm sản xuất</label>
          <select class="form-control" name="vintage" id="vintage">
            <option value="">Năm sản xuất</option>
            @foreach($vintages as $vintage)
              <option {{old("vintage") == $vintage->vintage ? "selected" : ""}} value="{{$vintage->vintage}}">{{ $vintage->vintage }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group boxSelect">
          <label for="nation">Quốc gia</label>
          <select class="form-control text-capitalize" name="nation">
            <option value="">Quốc gia</option>
            @foreach($nations as $nation)
              <option {{old("nation") == $nation->nation ? "selected" : ""}} value="{{$nation->nation}}">{{ $nation->nation }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group boxSelect">
          <label for="category">Loại rượu</label>
          <select class="form-control text-capitalize" name="category">
            <option value="">Loại rượu</option>
            @foreach($categories as $category)
              <option {{old("category") == $category->slug ? "selected" : ""}} value="{{$category->slug}}">{{$category->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group boxSelect">
          <label for="price">Giá tiền</label>
          <select class="form-control" name="price" id="price">
            <option value="">Giá tiền</option>
            <option {{old("price") == "<5" ? "selected" : ""}} value="<5">Dưới 5 triệu</option>
            <option {{old("price") == "5-10" ? "selected" : ""}} value="5-10">5 - 10 triệu</option>
            <option {{old("price") == "10-20" ? "selected" : ""}} value="10-20">10 - 20 triệu</option>
            <option {{old("price") == ">20" ? "selected" : ""}} value=">20">Trên 20 triệu</option>
          </select>
        </div>

        <button type="submit" class="btn btn-dark">{{__('client.filter')}}</button>
      </form>

    </div>


    <div class="col-xl-12 col-md-6 col-sm-12">
      <h4 class="pt-4 pb-3 mt-5 text-capitalize">{{__('client.top_products')}}</h4>
      <div class="productList p-3">
        @foreach($proOrderBought as $product)
          <div class="row">
            <div class="col-4 text-center productList__item p-0">
              <a href="{{route('shop.show',$product->slug)}}">
                <img src="{{asset('storage/'.$product->thumbnail)}}" style="width:100% !important" alt="" >
              </a>
            </div>
            <div class="col-8">
              <h4 class="mb-3" style=";"><a style="font-size:16px;" href="{{route('shop.show',$product->slug)}}">{{ \Illuminate\Support\Str::limit($product->name,40)}}</a></h4>
              @if($product->pricePresent('discount') != 0 && $product->pricePresent('discount') != null )
                <h5 style="color: #da3f19; ;">
                  {{$product->pricePresent('discount')}}
                  {{__('client.$')}}
                </h5>
              @else
                <h5 style="color: #da3f19; ;">
                  {{$product->pricePresent('price')}}
                  {{__('client.$')}}
                </h5>
              @endif
            </div>
          </div>
          <hr>
        @endforeach
      </div>
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
</div>
