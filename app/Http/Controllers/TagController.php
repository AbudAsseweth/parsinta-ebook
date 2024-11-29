<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tags.index', [
            "tags" => Tag::select('name', 'slug')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tag = new Tag();
        return view("tags.create", compact("tag"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        Tag::create([
            "name" => $name = $request->name,
            "slug" => str($name . " " . str()->random(3))->slug(),
        ]);

        return to_route('tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $articles = $tag->articles()->paginate(9);
        return view("tags.show", compact("tag", "articles"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view("tags.edit", compact("tag"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update([
            "name" => $name = $request->name,
            "slug" => str($name . " " . str()->random(3))->slug(),
        ]);

        return to_route("tags.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return to_route('tags.index');
    }
}
