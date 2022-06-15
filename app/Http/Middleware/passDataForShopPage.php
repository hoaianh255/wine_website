<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class passDataForShopPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
      $nations = Product::select('nation')->distinct()->get();
      $vintages = Product::select('vintage')->distinct()->get();
      $tagPrimary = Tag::where('primary','1')->limit('8')->get();
      $categories =  Category::join('language_switches', function ($join) {
        $join->on('language_id', '=', 'language_switches.id')
          ->where('language_switches.slug', '=', App()->getLocale());
      })->select('categories.*')->where('is_published','1')->where('type','0')->get();
      $proOrderBought = Product::join('language_switches', function ($join) {
        $join->on('language_id', '=', 'language_switches.id')
          ->where('language_switches.slug', '=', App()->getLocale());
      })->select('products.*')->where('is_published','1')->orderBy('bought','desc')->take(4)->get();
      View::share(['tagPrimary'=>$tagPrimary,'categories'=>$categories,'proOrderBought'=>$proOrderBought,'nations'=>$nations,'vintages'=>$vintages]);
      return $next($request);
    }
}
