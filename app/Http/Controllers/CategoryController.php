<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['auth', 'verified', 'only.admin'], except: ['show']),
        ];
    }

    public function index()
    {
        $categories = Category::withCount("articles")->get();
        return view("categories.index", compact("categories"));
    }

    public function show(Category $category)
    {
        $articles = $category->articles()->with(["category", "author", "tags"])->paginate(9);
        return view('categories.show', compact("category", "articles"));
    }

    public function create()
    {
        return view("categories.create");
    }

    public function store(CategoryRequest $request)
    {
        Category::create([
            "name" => $name = $request->name,
            "slug" => str($name . " " . str()->random(3))->slug(),
        ]);

        return to_route("categories.index");
    }

    public function edit(Request $request, Category $category)
    {
        return view("categories.edit", compact("category"));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update([
            "name" => $name = $request->name,
            "slug" => str($name . " " . str()->random(3))->slug(),
        ]);

        return to_route("categories.index");
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return to_route("categories.index");
    }
}
