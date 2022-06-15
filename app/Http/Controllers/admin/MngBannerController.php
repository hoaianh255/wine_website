<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\banner;
use App\Models\LanguageSwitch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MngBannerController extends Controller
{
    public function index(){
        $banner = banner::orderBy('order','desc')->paginate(12);
        return view('admin.banner.index')->with(["banner"=>$banner]);
    }
    public function orderPro($order)
    {
      if($order === "old"){
        $banner = banner::paginate(12);
        $old = "selected";
        return view('admin.banner.index',compact('banner','old'));
      }
        $new = "selected";
        $banner = banner::orderBy('created_at','desc')->paginate(12);
        return view('admin.banner.index',compact('banner','new'));
    }
    public function search(Request $request){
      $banner = banner::where('name','like','%'.$request->name.'%')->paginate(12);
      return view('admin.banner.index')->with(["banner"=>$banner]);
    }
    public function create(banner $id)
    {
      $languages = LanguageSwitch::all();
      return view('admin.banner.create')->with(['languages'=>$languages]);
    }

    public function store(Request $request)
    {
      $request->validate([
        'link' => ['required', 'string', 'max:255'],
        'order' => ['required', 'integer'],
        'thumbnail' => 'image|max:2048',
      ],
      [
        'link.required' => 'Mảng :attribute yêu cầu bắt buộc.',

        'order.required' => 'Mảng :attribute yêu cầu bắt buộc.',
        'order.integer' => 'Mảng :attribute yêu câu số nguyên.',

        'thumbnail.image' => 'Mảng :attribute yêu cầu là hình ảnh.',

        'thumbnail.max' => 'Mảng :attribute vượt quá mức băng thông cho phép (2048).',
      ]);
      $banner = new banner;
      $banner->name = $request->name;
      $banner->description = $request->description;
      $banner->link = $request->link;
      $banner->order = $request->order;
      $banner->language_id  = $request->language_id;
      if( $request->hasFile('thumbnail')){
        $name = $banner->id.$request->thumbnail->getClientOriginalName();
        $path = $request->thumbnail->storeAs('banner_images',$name,'public');
        $banner->thumbnail  = $path;
      }
      $saved = $banner->save();
      if($saved === false){
        Storage::delete($name);
      };
      session()->flash('success', 'Thêm Banner thành công');
      return redirect('/dashboard/banner');
    }

    public function edit(banner $id)
    {
      return view('admin.banner.edit')->with(['banner'=>$id]);
    }

    public function update(Request $request,$id)
    {
      $request->validate([
        'thumbnail' => 'image|max:2048',
      ],
      [
        'thumbnail.image' => 'Mảng :attribute yêu cầu là hình ảnh.',

        'thumbnail.max' => 'Mảng :attribute vượt quá mức băng thông cho phép (2048).',
      ]);
      $banner = banner::find($id);
      if(isset($request->name)){
        $banner->name = $request->name;
      }
      if(isset($request->description)){
        $banner->description = $request->description;
      }
      if(isset($request->link)){
        $banner->link = $request->link;
      }
      if(isset($request->order)){
        $banner->order = $request->order;
      }
      if(isset($request->language_id)){
        $banner->language_id = $request->language_id;
      }
      if( $request->hasFile('thumbnail')){
        $name = $banner->id.$request->thumbnail->getClientOriginalName();
        $path = $request->thumbnail->storeAs('banner_images',$name,'public');
        $banner->thumbnail  = $path;
      }
      $saved = $banner->save();
      if($saved === false){
        Storage::delete($name);
        
      };
      session()->flash('message','success');
      return redirect('/dashboard/banner');
    }

    public function destroy(banner $id)
    {
      $id->delete();
      session()->flash('message', 'Xóa Người dùng thành công');
      return redirect()->back();
    }
    
    public function deleteAll(Request $request) {
      $BannerId = explode(',',$request->BannerId[0]);
      $deleted = banner::whereIn('id',$BannerId)->delete();
      if($deleted) {
        return redirect()->back()->with('message', 'Da xoa thanh cong');
      }
      return redirect()->back()->with('message', 'Xoa khong thanh cong');
    }

}

