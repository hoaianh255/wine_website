<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function index()
  {
    $blogs = Blog::join('language_switches', function ($join) {
      $join->on('language_id', '=', 'language_switches.id')
        ->where('language_switches.slug', '=', App()->getLocale());
    })->select('blogs.*')->where('is_published', '1')->orderBy('created_at', 'desc')->get();

    session()->forget('message');
    return view('client.blog')->with('blogs', $blogs);
  }

  public function show(Blog $blog)
  {
    $blogPOST = Blog::join('language_switches', function ($join) {
      $join->on('language_id', '=', 'language_switches.id')->where('language_switches.slug', '=', App()->getLocale());
    }
    )->select('blogs.*')->where('is_published', '1')->where('especially', '1')->inRandomOrder()->take(4)->orderBy('view', 'desc')->get();
    
    DB::table('blogs')
    ->where('id', $blog->id)
    ->increment('view');

    return view('client.blogdetails')->with(['blogs' => $blogPOST, 'blog' => $blog]);

  }

  public function search(Request $request)
  {
    $blogs = Blog::join('language_switches', function ($join) {
      $join->on('blogs.language_id', '=', 'language_switches.id')
        ->where('language_switches.slug', '=', App()->getLocale());
    })->select('blogs.*')->where('is_published', '1')->orderBy('created_at', 'desc')
      ->where('blogs.title', 'like', '%' . $request->searching . '%')
      ->where('blogs.is_published', '1')->distinct()->get();
    return view('client.blog')->with(['blogs' => $blogs,'message'=>__('searching').': '.$request->searching]);
  }

  public function getBlogByCat(Category $slug)
  {
    $blogPOST = $slug->blogs()->join('language_switches', function ($join) {
      $join->on('language_id', '=', 'language_switches.id')
        ->where('language_switches.slug', '=', App()->getLocale());
    })->select('blogs.*')->where('is_published','1')->orderBy('created_at','desc')->paginate(8);

    return view('client.blog')->with(['blogs' => $blogPOST,'message'=>__('category').': '.$slug->name]);
  }

  public function searchWithTag(Tag $tag)
  {
    $blogPOST =$blogs = Blog::join('language_switches', function ($join) {
      $join->on('blogs.language_id', '=', 'language_switches.id')
        ->where('language_switches.slug', '=', App()->getLocale());
    })->join('tags', 'blogs.id', '=', 'tags.blog_id')
      ->where('blogs.slug', 'like', '%' . $tag->name. '%')
      ->orWhere('blogs.title', 'like', '%' . $tag->name. '%')
      ->orWhere('blogs.description', 'like', '%' . $tag->name. '%')
      ->orWhere('blogs.content', 'like', '%' . $tag->name. '%')
      ->orWhere('tags.name', 'like', '%' .$tag->name . '%')
      ->distinct()
      ->get();

    return view('client.blog')->with(['blogs' => $blogPOST,'message'=>__('tag').': '.$tag->name]);
  }

  public function delete(Blog $id)
    {
        $id->delete();
        session()->flash('success', 'Xóa bài viết thành công');
        return redirect()->back();
    }

}
