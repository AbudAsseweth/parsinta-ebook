<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $articles = Article::query()->published()->latest()->with(['author', 'category', 'tags'])->limit(6)->get();
        return view("home", compact("articles"));
    }
}
