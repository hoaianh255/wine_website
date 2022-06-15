<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{

    public function index(){
      $products =  Product::join('language_switches', function ($join) {
        $join->on('language_id', '=', 'language_switches.id')
          ->where('language_switches.slug', '=', App()->getLocale());
      })->select('products.*')->where('is_published','1')->orderBy('id','desc')->paginate(12);
      return view('client.shop')->with(['products'=>$products]);
    }

    public function show(Product $product){
      $idRelation = [];
      $arrProRel = $product->productRelation()->get();
      foreach ($arrProRel as $id){
        $idRelation[] = $id->product_relation_id;
      }
      $productRelations = Product::whereIn('id',$idRelation)->limit('3')->get();
      DB::table('products')
      ->where('id', $product->id)
      ->increment('view');
      return view('client.productdetail')
        ->with(['product'=>$product,'productRelations'=>$productRelations]);
    }
    public function getProByCat(Category $slug){
      $products = $slug->products()->join('language_switches', function ($join) {
        $join->on('language_id', '=', 'language_switches.id')
          ->where('language_switches.slug', '=', App()->getLocale());
      })->select('products.*')->where('is_published','1')
        ->orderBy('created_at','desc')->paginate(12);
      return view('client.shop')
        ->with(['products'=>$products,'message'=>$slug->name,'category'=>$slug->slug]);
    }

    public function getProByNat($slug)
    {
      $products = Product::join('language_switches', function ($join) {
      $join->on('language_id', '=', 'language_switches.id')
        ->where('language_switches.slug', '=', App()->getLocale());
    })->select('products.*')->where('is_published','1')->where('nation',$slug)->orderBy('id','desc')->paginate(12);
      session()->flash('message',__('nation').": ".$slug);
      return view('client.shop')
        ->with(['products'=>$products]);
    }
    public function searchWithTag(Tag $tag){
      $products = Product::join('language_switches', function ($join) {
        $join->on('language_id', '=', 'language_switches.id')
          ->where('language_switches.slug', '=', App()->getLocale());
      })
        ->join('tags','products.id','=','tags.product_id')
        ->where('tags.slug','=',$tag->slug)
        ->where('is_published','1')
        ->select('products.*')
        ->paginate(6);
      return view('client.shop')->with(['products'=>$products,'message'=>"Tag : ".$tag->name]);
    }

  public function searchByName(Request $request)
  {
    $products = [];
    if ($request->filled('searching')){
      $products = Product::join('language_switches', function ($join) {
        $join->on('language_id', '=', 'language_switches.id')
          ->where('language_switches.slug', '=', App()->getLocale());
      })->where('products.name','like','%'.$request->searching.'%')->where('is_published','1')->select('products.*')->paginate(12);

    }
    return view('client.shop')
      ->with(['products'=>$products,'message'=>'Tìm kiếm : '.$request->searching]);
  }
      public function filterProducts(Request $request)
      {
        $products = Product::query();
        $products->join('language_switches', function ($join) {
          $join->on('language_id', '=', 'language_switches.id')
            ->where('language_switches.slug', '=', App()->getLocale());
        });
        if($request->filled('category')){
          $products->join('category_products','products.id','=','category_products.product_id')
            ->join('categories','category_products.category_id','=','categories.id')
            ->where('categories.slug','=',$request->category);
        }
        if($request->filled('sortBy')){
          if($request->sortBy === 'asc'){
            $products->orderBy('products.id','asc');
          }
          if($request->sortBy === 'desc'){
            $products->orderBy('products.id','desc');
          }
        }
        if($request->filled('vintage')){
          $products->where('products.vintage','=',$request->vintage);
        }
        if($request->filled('nation')){
          $products->where('products.nation','=',$request->nation);
        }
        if($request->filled('price')) {
          switch ($request->price) {
            case '<5':
              $products->where('products.price', '<', 5000000);
              break;
            case '5-10':
              $products->whereBetween('price', [5000000, 10000000]);
              break;
            case '10-20':
              $products->whereBetween('price', [10000000, 20000000]);
              break;
            case '>20':
              $products->where('price', '>', 20000000);
              break;
            default:
              break;
          }
        }
          $request->flash();
            $allPros = $products->select('products.*')->where('products.is_published','1')->paginate(12);
           return view('client.shop')->with(['products'=>$allPros,'message'=>"Sản phẩm tìm được"]);
        }


}
