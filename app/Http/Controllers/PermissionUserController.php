<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PermissionUserController extends Controller
{
    public function create(User $user)
    {
        if ($user->isStaffUser()){
            return view('admin.users.permission',compact('user'));

        }
        return back();
    }

    public function store(Request $request , User $user)
    {
       if ($request->input('permissions')){
           $user->permissions()->sync($request->input('permissions'));
       }else{
           $user->permissions()->detach();
       }
        if ($request->input('roles')){
            $user->roles()->sync($request->input('roles'));
        }else{
            $user->roles()->detach();
        }

        alert()->success('دسترسی های کاربر اعمال شد');

        return redirect(route('admin.users.index'));

    }
}
