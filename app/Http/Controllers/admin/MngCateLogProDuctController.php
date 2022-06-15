<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LanguageSwitch;
use Illuminate\Http\Request;

class MngCateLogProDuctController extends Controller
{
    public function index(){
        $categoryPro = Category::where('type','=','0')->orderBy('created_at','desc')->paginate(12);
        return view('admin.category.product.index')->with(["categoryPro"=>$categoryPro]);
    }

    public function orderPro($order)
    {
      if($order === "old"){
        $categoryPro = Category::where('type','=','0')->paginate(12);
        $old = "selected";
        return view('admin.category.product.index',compact('categoryPro','old'));
      }
        $new = "selected";
        $categoryPro = Category::where('type','=','0')->orderBy('created_at','desc')->paginate(12);
        return view('admin.category.product.index',compact('categoryPro','new'));
    }
    public function search(Request $request){
      $categoryPro = Category::
      where('name','like','%'.$request->name.'%')->where('type','=','0')
      ->paginate(12);
      return view('admin.category.product.index')->with(["categoryPro"=>$categoryPro]);
    }

    public function create(Category $id)
    {
        $languages = LanguageSwitch::all();
      return view('admin.category.product.create')->with(['languages'=>$languages]);
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
      $categoryPro = new Category;
      $categoryPro->user_id = $user_id;
      $categoryPro->name = $request->name;
      $categoryPro->slug = str_slug($request->name);
      $categoryPro->type = $request->type;
      $categoryPro->is_published  = $request->is_published;
      $categoryPro->language_id  = $request->language_id;
      $categoryPro->order = $request->order;
      $saved = $categoryPro->save();
      session()->flash('success', 'Thêm Danh mục Sản phẩm thành công');
      return redirect('/dashboard/categories_products');
    }

    public function edit(Category $id)
    {
      return view('admin.category.product.edit')->with(['categoryPro'=>$id]);
    }

    public function update(Request $request,$id)
    {
      $categoryPro = Category::find($id);
      if(isset($request->name)){
        $categoryPro->name = $request->name;
      }
      if(isset($request->type)){
        $categoryPro->type = $request->type;
      }
      if(isset($request->is_published)){
        $categoryPro->is_published = $request->is_published;
      }
      if(isset($request->language_id)){
        $categoryPro->language_id = $request->language_id;
      }
      $saved = $categoryPro->save();
      session()->flash('message','success');
      return redirect('/dashboard/categories_products');
    }

    public function destroy(Category $id)
    {
      $id->delete();
      session()->flash('message', 'Xóa Người dùng thành công');
      return redirect()->back();
    }

    public function deleteAll(Request $request) {
      $CateLogProDuctId = explode(',',$request->CateLogProDuctId[0]);
      $deleted = Category::whereIn('id',$CateLogProDuctId)->delete();
      if($deleted) {
        return redirect()->back()->with('message', 'Da xoa thanh cong');
      }
      return redirect()->back()->with('message', 'Xoa khong thanh cong');
    }

}
