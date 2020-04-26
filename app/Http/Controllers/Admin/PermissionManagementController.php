<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class PermissionManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->hasRole('Admin')) {
                return redirect('/employee-dashboard');
            }
            return $next($request);
        });
    }

    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        $userPermissions = $user->getAllPermissions()->pluck('id')->toArray();
        $permissions = DB::table('permissions')->get();
        return view('admin.permission-managements.edit', compact('user','permissions', 'userPermissions'));
    }

    public function updatePermission(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $user->syncPermissions($request->permission_ids);
        return redirect('/users')->with('flashMessage', 'Permissions Updated');
    }

}
