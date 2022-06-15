<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MngUserController extends Controller
{
    public function index()
    {
      $users = User::orderBy('id','desc')->paginate(12);
      return view('admin.user.index')->with(["users"=>$users]);
    }
    public function orderPro($order)
    {
      if($order === "old"){
        $users = User::paginate(12);
        $old = "selected";
        return view('admin.user.index',compact('users','old'));
      }
        $new = "selected";
        $users = User::orderBy('id','desc')->paginate(12);
        return view('admin.user.index',compact('users','new'));
    }
    public function search(Request $request){
      $users = User::where('name','like','%'.$request->name.'%')->paginate(12);
      return view('admin.user.index')->with(["users"=>$users]);
    }
    public function create(User $id)
    {
      return view('admin.user.create');
    }

    public function store(Request $request)
    {
      $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
      ],
      [
        'name.required' => 'Mảng :attribute yêu cầu bắt buộc.',

        'email.required' => 'Mảng :attribute yêu cầu bắt buộc.',
        'email.unique' => 'Mảng :attribute đã tồn tại',

        'password.required' => 'Mảng :attribute yêu cầu bắt buộc.',
        'password.min.string' => 'Mảng :attribute quá ngắn.',
        'password.confirmed' => 'Mảng :attribute của :attribute confirmed không khớp.',
      ]);
      $data=array(
          'name'=>$request->name,
          'avatar'=>$request->avatar,
          'email'=>$request->email,
          'password'=> Hash::make($request['password']),
      );
      User::create($data);
      session()->flash('success', 'Thêm tài khoản thành công');

      return redirect('/dashboard/user');
    }

    public function edit(User $id)
    {
      $newRoles = [];
      $rolesChecked = $id->roles()->get();
      $roles = Role::all();
      foreach ($roles as $role){
        $role['checked'] = false;
        foreach ($rolesChecked as $roleChecked){
          if ($role['slug'] === $roleChecked->slug){
            $role['checked'] = true;
          }
        }
          $newRoles[] = $role;
      }
      return view('admin.user.edit')->with(['user'=>$id,'roles'=>$newRoles]);
    }

    public function update(Request $request,$id)
    {
      $user = User::find($id);
      if(isset($request->name)){
        $user->name = $request->name;
      }
      if(isset($request->phone)){
        $user->phone = $request->phone;
      }
      if(isset($request->address)){
        $user->address = $request->address;
      }
      $updated = $user->save();
      if(isset($request->roles) && $updated == true){
        $user->roles()->sync($request->roles);
      }
      session()->flash('message','success');
      return redirect()->back();

    }

    public function destroy(User $id)
    {
      $id->delete();
      session()->flash('message', 'Xóa Người dùng thành công');
      return redirect()->back();
    }

    public function deleteAll(Request $request) {
      $users_id = explode(',',$request->user_id[0]);
      $deleted = User::whereIn('id',$users_id)->delete();
      if($deleted) {
        return redirect()->back();
      }
      return redirect()->back();
    }
}
