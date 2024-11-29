<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;

class UserController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['show']),
            new Middleware('only.admin', only: ['index']),
        ];
    }

    public function index(Request $request)
    {
        $users = User::whereNotNull("email_verified_at")
            ->whereNot('id', $request->user()->id)
            ->with('roles')
            ->get();
        $roles = Role::query()->select("id", "name")->get();
        return view("users.index", compact("users", "roles"));
    }

    public function show(User $user)
    {
        $articles = Article::query()->published()->whereUserId($user->id)->with(['author', 'category', 'tags'])->latest()->paginate(9);
        return view("users.show", compact("user", "articles"));
    }

    public function edit(User $user)
    {
        return view("users.edit", compact("user"));
    }

    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            "name" => "required|string|min:8|max:191",
            "username" => [
                "required",
                "string",
                "alpha_num",
                "min:6",
                "max:25",
                Rule::unique('users')->ignore($user),
            ],
            "email" => [
                "required",
                "email",
                Rule::unique('users')->ignore($user),
            ],
        ]);

        $user->update($attributes);

        return to_route("users.edit", $user);
    }
}
