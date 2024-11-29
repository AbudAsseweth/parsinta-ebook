<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            "name" => ['required'],
            "email" => ['required', Rule::unique("users", "email")],
            "password" => ['required', "min:8", "confirmed"],
        ]);

        tap(User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]), function ($user) {
            Auth::login($user);
            event(new Registered($user));
            $user->update([
                'username' => $user->id . now(),
            ]);
        });

        return to_route("verification.notice");
    }
}
