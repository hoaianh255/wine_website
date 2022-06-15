<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\LanguageSwitch;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MngBlogController extends Controller
{
    public function index(Blog $blog)
    {
      $blogs = Blog::orderBy('created_at','desc')->paginate(12);
      $tags = Tag::select('tags.*')->where('primary', '1')->get();
      return view('admin.post.index')->with(["blog"=>$blog,"blogs"=>$blogs,"tags"=>$tags]);
    }

    public function orderPro($order)
    {
      if($order === "old"){
        $tags = Tag::select('tags.*')->where('primary', '1')->get();
        $categorys = Category::select('categories.*')->where('is_published','1')->where('type','1')->get();
        $blogs = Blog::paginate(12);
        $old = "selected";
        return view('admin.post.index',compact('blogs','old','tags','categorys'));
      }
        $new = "selected";
        $tags = Tag::select('tags.*')->where('primary', '1')->get();
        $categorys = Category::select('categories.*')->where('is_published','1')->where('type','1')->get();
        $blogs = Blog::orderBy('created_at','desc')->paginate(12);
        return view('admin.post.index',compact('blogs','new','tags','categorys'));
    }
    public function search(Request $request){
        $tags = Tag::select('tags.*')->where('primary', '1')->get();
        $categorys = Category::select('categories.*')->where('is_published','1')->where('type','1')->get();
        $blogs = Blog::
        where('title','like','%'.$request->title.'%')
        ->paginate(12);
        return view('admin.post.index')->with(["blogs"=>$blogs,"tags"=>$tags,"categorys"=>$categorys]);
    }


    public function create()
    {

      $categories = Category::where('type','=','1')->get();
      $languages = LanguageSwitch::all();
      $Tag = Tag::select('tags.*')->where('primary', '1')->get();
      return view('admin.post.create')->with(['categories'=>$categories,'languages'=>$languages,'Tag'=>$Tag]);
    }

    public function store(Request $request)
    {

      $request->validate([
          'title' => 'required | string | max:255',
          'description' => 'required | string',
          'contentProduct' => 'required | string',
          'thumbnail' => 'image|max:2048',
      ],
      [
          'title.required' => 'Mảng :attribute yêu cầu bắt buộc.',

          'description.required' => 'Mảng :attribute yêu cầu bắt buộc.',

          'contentProduct.required' => 'Mảng :attribute yêu cầu bắt buộc.',

          'thumbnail.image' => 'Mảng :attribute yêu cầu là hình ảnh.',

          'thumbnail.max' => 'Mảng :attribute vượt quá mức băng thông cho phép (2048).',
      ]);
      $user_id = Auth()->user()->id;
      $blogs = new Blog;
      $blogs->user_id = $user_id;
      $blogs->title = $request->title;
      $blogs->slug = str_slug($request->title);
      if( $request->hasFile('thumbnail')){
        $name = $blogs->id.$request->thumbnail->getClientOriginalName();
        $path = $request->thumbnail->storeAs('blog_images',$name,'public');
        $blogs->thumbnail  = $path;
      }
      $blogs->description = $request->description;
      $blogs->content = $request->contentProduct;
      $blogs->language_id  = $request->language_id;
      $blogs->is_published  = $request->is_published;
      $blogs->especially  = $request->especially;
      $saved = $blogs->save();
      if(isset($request->categories) && $saved === true){
        $blogs->categories()->sync($request->categories);
      }
      if($saved === false){
        Storage::delete($name);
      };
      session()->flash('success', 'Thêm thành công');

      return redirect()->route('MngBlog.index');
    }


    public function edit(Blog $id)
    {
      $categories = [];
      $CategoryCheckeds = $id->categories()->get();
      $AllCategory = Category::where('type','1')->get();
      foreach ($AllCategory as $Category){
        $Category['checked'] = false;
        foreach ($CategoryCheckeds as $CategoryChecked){
          if ($Category['slug'] === $CategoryChecked->slug){
            $Category['checked'] = true;
          }
        }
          $categories[] = $Category;
      }
      return view('admin.post.edit')->with(['blogs'=>$id,'categories'=>$categories]);
    }

    public function update(Request $request,$id)
    {
      $request->validate([
        'thumbnail' => 'image|max:2048',
      ],
      [
          'thumbnail.image' => 'Mảng :attribute yêu cầu là hình ảnh.',
          
      ]);
      $blogs = Blog::find($id);
      $user_id = Auth()->user()->id;
      $slug = str_slug($request->title);
      if(isset($request->user_id)){
        $blogs->user_id = $request->user_id;
      }
      if(isset($request->slug)){
        $blogs->slug = $request->slug;
      }
      if(isset($request->title)){
        $blogs->title = $request->title;
      }
      if( $request->hasFile('thumbnail')){
        $name = $blogs->id.$request->thumbnail->getClientOriginalName();
        $path = $request->thumbnail->storeAs('blog_images',$name,'public');
        $blogs->thumbnail  = $path;
      }
      if(isset($request->description)){
        $blogs->description = $request->description;
      }
      if(isset($request->contentProduct)){
        $blogs->content = $request->contentProduct;
      }
      if(isset($request->is_published)){
        $blogs->is_published = $request->is_published;
      }
      if(isset($request->especially)){
        $blogs->especially = $request->especially;
      }
      if(isset($request->language_id)){
        $blogs->language_id = $request->language_id;
      }
      $saved = $blogs->save();
      /* Lỗi ở đây */
      if(isset($request->categories) && $saved === true){
        $blogs->categories()->sync($request->categories);
      }
      if($saved === false){
        Storage::delete($name);

      };
      session()->flash('message','success');
      return redirect()->back();
    }


    public function destroy(Blog $id)
    {
      $id->delete();
      session()->flash('message', 'Xóa Người dùng thành công');
      return redirect()->back();
    }

    public function deleteAll(Request $request) {
      $BlogId = explode(',',$request->BlogId[0]);
      $deleted = Blog::whereIn('id',$BlogId)->delete();
      if($deleted) {
        return redirect()->back()->with('message', 'Da xoa thanh cong');
      }
      return redirect()->back()->with('message', 'Xoa khong thanh cong');
    }
}
