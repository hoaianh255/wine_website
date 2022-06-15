<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{


//    public function show()
//    {
//        return view('client.profile');
//    }
  public function edit()
  {
    $roles = Auth::user()->roles()->get();
    return view('client.profile')->with(['roles'=>$roles]);
  }

  public function update(Request $request)
  {
    $this->validate($request, [
      'image' => 'image|max:2048',
    ],
    [
      'thumbnail.image' => 'Mảng :attribute yêu cầu là hình ảnh.',
      'thumbnail.max' => 'Mảng :attribute vượt quá mức băng thông cho phép (2048).',
    ]);
    $user = Auth()->user();
    if(isset($request->name)){
      $user->name = $request->name;
    }
    if($request->hasFile('image')){
      $path = $user->id.$request->image->getClientOriginalName();
      $user->avatar = $path;
      $request->image->storeAs('avatar_user',$path,'public');
    }
    if(isset($request->phone)){
      $user->phone = $request->phone;
    }
    if(isset($request->address)){
      $user->address = $request->address;
    }
    if(isset($request->avatar)){
      $user->avatar = $request->avatar;
    }
    $updated = $user->save();
    if($updated){
      session()->flash('message', 'Sửa thông tin thành công');
      return redirect()->back();
    }
    session()->flash('success', 'Sửa thông tin thất bại');

    return redirect()->back();
  }
}
