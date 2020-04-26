<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:10',
            'email' => 'required|email|unique:users',
        ]);

        $user           = new User();
        $user->name     = ucfirst(trans($request->name));
        $user->email    = $request->email;
        $user->password = Hash::make('12345678');
        $user->save();

        $role = Role::where('id', 1)->first();
        $user->roles()->attach($role);

        return redirect('/users')->with('flashMessage', 'User added successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user        = User::findOrFail($id);
        $requestData = array();
        $requestData['name']  = $request->name;
        $requestData['email'] = $request->email;
        if($request->status){
            $requestData['status'] = 1;
        }else{
            $requestData['status'] = 0;
        }
        $requestData['updated_by'] = Auth::user()->email;
        $user->update($requestData);

        if($request->role){
            $role = Role::where('id', $request->role)->first();
            $user->roles()->sync($role);
        }
        return redirect('/users')->with('flashMessage', 'User Update Successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->image){
            $deleteImage = 'storage/users/'.$user->image;
            unlink($deleteImage);
        }
        User::destroy($id);
        return redirect()->back()->with('flashMessage', 'User deleted successfully');
    }

    public function userSettings()
    {
        return view('admin.users.settings');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password',
        ]);

        if(Auth::user()->id){
            if (Hash::check($request->old_password, Auth::user()->password)) {
                DB::table('users')
                ->where('id', Auth::user()->id)
                ->update([
                    'password'  => Hash::make($request->new_password)
                ]);
                return redirect()->back()->with('flashMessage', 'Password Changed Successfully');
            }else{
                return redirect()->back()->with('flashMessageError', 'Old Password Not Matched');
            }
        }else{
            return redirect()->back()->with('flashMessageError', 'User not found');
        }
    }

    public function uploadImage($image, $uploadPath)
    {
        $now = Carbon::now();
        $imageName = $now->year.$now->month.$now->day.$now->hour.$now->minute.$now->second.Str::random(10).'.'.$image->getClientOriginalExtension();
        $image->move($uploadPath, $imageName);
        return $imageName;
    }

    public function changeUserImage(Request $request)
    {
        $user        = Auth::user();
        $requestData = array();
        if ($request->hasfile('image')) {
            if ($user->image) {
                $deleteImage = 'storage/users/'.$user->image;
                unlink($deleteImage);
            }
            $image                = $request->file('image');
            $uploadPath           = 'storage/users/';
            $requestData['image'] = $this->uploadImage($image, $uploadPath);
        }
        $user->update($requestData);
        return redirect()->back()->with('flashMessage', 'Image Updated Successfully');
    }


}
