<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;

class HomePageController extends Controller
{
    public function index(){

      $banner = banner::join('language_switches',function ($join){
        $join->on('language_id','=','language_switches.id')->where('language_switches.slug','=',App()->getLocale());
      })->select('banners.*')->orderBy('created_at','desc')->limit(3)->get();

      $categories = Category::join('language_switches',function ($join){
        $join->on('language_id','=','language_switches.id')->where('language_switches.slug','=',App()->getLocale());
      })->select('categories.*')->where('type','0')->get();

      $productsEsp = Product::join('language_switches', function ($join) {
          $join->on('language_id', '=', 'language_switches.id')
              ->where('language_switches.slug', '=', App()->getLocale());
      })->select('products.*')->where('is_published','1')->where('especially','1')->inRandomOrder()->take(6)->get();

      $productsRec = Product::join('language_switches', function ($join) {
        $join->on('language_id', '=', 'language_switches.id')
          ->where('language_switches.slug', '=', App()->getLocale());
      })->select('products.*')->where('is_published','1')->orderBy('view','desc')->take(8)->get();
      
      $blogs_esp = Blog::join('language_switches', function ($join) {
        $join->on('language_id', '=', 'language_switches.id')
          ->where('language_switches.slug', '=', App()->getLocale());
      })->select('blogs.*')->where('is_published','1')->where('especially','1')->inRandomOrder()->take(3)->orderBy('view','desc')->get();
      return view('client.homepage')->with(['productsEsp'=>$productsEsp,'productsRec'=>$productsRec,'blogs_esp'=>$blogs_esp,'categories'=>$categories,'banner'=>$banner]);
    }
}
