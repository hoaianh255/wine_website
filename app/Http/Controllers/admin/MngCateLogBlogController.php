<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LanguageSwitch;
use Illuminate\Http\Request;

class MngCateLogBlogController extends Controller
{
    public function index(){
        $categoryBlog = Category::where('type','=','1')->orderBy('created_at','desc')->paginate(12);
        return view('admin.category.blog.index')->with(["categoryBlog"=>$categoryBlog]);
    }

    public function orderPro($order)
    {
      if($order === "old"){
        $categoryBlog = Category::where('type','=','1')->paginate(12);
        $old = "selected";
        return view('admin.category.blog.index',compact('categoryBlog','old'));
      }
        $new = "selected";
        $categoryBlog = Category::where('type','=','1')->orderBy('created_at','desc')->paginate(12);
        return view('admin.category.blog.index',compact('categoryBlog','new'));
    }
    public function search(Request $request){
      $categoryBlog = Category::
      where('name','like','%'.$request->name.'%')->where('type','=','1')
      ->paginate(12);
      return view('admin.category.blog.index')->with(["categoryBlog"=>$categoryBlog]);
    }

    public function create(Category $id)
    {
        $languages = LanguageSwitch::all();
      return view('admin.category.blog.create')->with(['languages'=>$languages]);
    }

    public function store(Request $request)
    {
      $request->validate([
        'name' => ['required', 'string', 'max:255','unique:categories'],
      ],
      [
        'name.required' => 'Mảng :attribute yêu cầu bắt buộc.',
        'name.unique'=>'Tên danh mục đã bị trùng mời nhập tên khác',
      ]);
      $user_id = Auth()->user()->id;
      $categoryBlog = new Category;
      $categoryBlog->user_id = $user_id;
      $categoryBlog->name = $request->name;
      $categoryBlog->slug = str_slug($request->name);
      $categoryBlog->type = $request->type;
      $categoryBlog->is_published  = $request->is_published;
      $categoryBlog->language_id  = $request->language_id;
      $categoryBlog->order = $request->order;
      $saved = $categoryBlog->save();
      session()->flash('success', 'Thêm Danh mục Sản phẩm thành công');
      return redirect('/dashboard/categories_blogs');
    }

    public function edit(Category $id)
    {
      return view('admin.category.blog.edit')->with(['categoryBlog'=>$id]);
    }

    public function update(Request $request,$id)
    {
      $categoryBlog = Category::find($id);
      if(isset($request->name)){
        $categoryBlog->name = $request->name;
      }
      if(isset($request->type)){
        $categoryBlog->type = $request->type;
      }
      if(isset($request->is_published)){
        $categoryBlog->is_published = $request->is_published;
      }
      if(isset($request->language_id)){
        $categoryBlog->language_id = $request->language_id;
      }
      $saved = $categoryBlog->save();
      session()->flash('message','success');
      return redirect('/dashboard/categories_blogs');
    }

    public function destroy(Category $id)
    {
      $id->delete();
      session()->flash('message', 'Xóa Người dùng thành công');
      return redirect()->back();
    }

    public function deleteAll(Request $request) {
      $CateLogBlogId = explode(',',$request->CateLogBlogId[0]);
      $deleted = Category::whereIn('id',$CateLogBlogId)->delete();
      if($deleted) {
        return redirect()->back()->with('message', 'Da xoa thanh cong');
      }
      return redirect()->back()->with('message', 'Xoa khong thanh cong');
    }

}
