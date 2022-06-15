<?php

namespace App\Http\Middleware;

use App\Models\Blog;
use App\Models\Category;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class passDataForBlogPage
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
      $blogsRecent = Blog::join('language_switches', function ($join) {
        $join->on('language_id', '=', 'language_switches.id')
          ->where('language_switches.slug', '=', App()->getLocale());
      })->select('blogs.*')->where('is_published', '1')->orderBy('view', 'desc')->take(4)->get();
      $categorieBlog =  Category::join('language_switches', function ($join) {
        $join->on('language_id', '=', 'language_switches.id')
          ->where('language_switches.slug', '=', App()->getLocale());
      })->select('categories.*')->where('is_published','1')->where('type','1')->get();
      $tagPrimary = DB::table('tags')->where('primary','1')->limit('8')->get();
      if(count($blogsRecent) > 0 || count($categorieBlog) > 0 || $tagPrimary > 0) {
        View::share(['categoriesBlog' => $categorieBlog, 'tagPrimary' => $tagPrimary, 'blogsRecent' => $blogsRecent]);
      }
      return $next($request);
    }
}
