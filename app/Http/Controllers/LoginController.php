<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view("auth.login");
    }

    public function loginUser(Request $request)
    {
        // validasi data
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $user = User::where('email', $request->email)->first();

        // check apakah password sama
        if (!Hash::check($request->password, $user?->password)) {
            throw ValidationException::withMessages([
                "email" => "There credentials do not match our records.",
            ]);
        }

        Auth::login($user, $request->remember);

        return to_route("home");
    }
}
