<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class MngTagsController extends Controller
{
    public function index(){
        $tags = Tag::orderBy('created_at','desc')->where('primary','1')->paginate(12);
        return view('admin.tag.index')->with(["tags"=>$tags]);
    }
    public function orderPro($order)
    {
      if($order === "old"){
        $tags = Tag::paginate(12);
        $old = "selected";
        return view('admin.tag.index',compact('tags','old'));
      }
        $new = "selected";
        $tags = Tag::orderBy('created_at','desc')->paginate(12);
        return view('admin.tag.index',compact('tags','new'));
    }
    public function search(Request $request){
      $tags = Tag::where('name','like','%'.$request->name.'%')->paginate(12);
      return view('admin.tag.index')->with(["tags"=>$tags]);
    }

    public function create()
    {
      return view('admin.tag.create');
    }

    public function store(Request $request)
    {
      $request->validate([
          'name' => 'required | string | max:255',
      ],
      [
          'name.required' => 'Mảng :attribute yêu cầu bắt buộc.',
      ]);
      $tags = new Tag();
      $tags->name = $request->name;
      $tags->slug = str_slug($request->name);
      $tags->primary = $request->primary;
      $saved = $tags->save();
      session()->flash('success', 'Thêm thành công');

      return redirect()->route('MngTags.index');
    }

    public function edit(Tag $id)
    {
      return view('admin.tag.edit')->with(['tags'=>$id]);
    }

    public function update(Request $request,$id)
    {
      $tags = Tag::find($id);
      if(isset($request->name)){
        $tags->name = $request->name;
      }
      if(isset($request->primary)){
        $tags->primary = $request->primary;
      }
      $saved = $tags->save();
      session()->flash('message','success');
      return redirect('/dashboard/tags');
    }

    public function destroy(Tag $id)
    {
      $id->delete();
      session()->flash('message', 'Xóa Người dùng thành công');
      return redirect()->back();
    }
    
    public function deleteAll(Request $request) {
      $TagId = explode(',',$request->TagId[0]);
      $deleted = Tag::whereIn('id',$TagId)->delete();
      if($deleted) {
        return redirect()->back()->with('message', 'Da xoa thanh cong');
      }
      return redirect()->back()->with('message', 'Xoa khong thanh cong');
    }

}
