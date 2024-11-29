<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();
        return view("password.edit", compact("user"));
    }

    public function update(Request $request)
    {
        $request->validate([
            "current_password" => ["required"],
            "password" => "required|min:8|max:30|alpha_num|confirmed"
        ]);

        if (! Hash::check($request->current_password, $request->user()->password)) {
            return back()->withErrors([
                'current_password' => ['The provided current password does not match our records.']
            ]);
        }

        $request->user()->update([
            "password" => bcrypt($request->password),
        ]);

        return to_route("change-password.edit")->with("status", "Your password has been changed successfully");
    }
}
