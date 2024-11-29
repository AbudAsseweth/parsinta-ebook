<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller implements HasMiddleware
{
    private $categories = null;
    private $tags = null;

    public function __construct()
    {
        $this->categories = Category::select("id", "name")->get();
        $this->tags = Tag::select("id", "name")->get();
    }

    public static function middleware(): array
    {
        return [
            new Middleware(['verified', 'can.write.article'], except: ['show', "index"]),
            new Middleware('only.admin', only: ['updateStatus']),
        ];
    }

    public function table(Request $request)
    {
        $articles = Article::query()->with('author')
            ->latest()
            ->when(!$request->user()->isAdmin(), fn(Builder $query) => $query->whereBelongsTO('user_id', $request->user()))
            ->paginate(9);
        return view("articles.table", compact("articles"));
    }

    public function updateStatus(Request $request, Article $article)
    {
        $article->update([
            'status' => $request->status,
            'published_at' => $request->status == ArticleStatus::APPROVED->value ? now() : null,
        ]);

        $action = $request->status == ArticleStatus::APPROVED ? "published" : "taken down";
        return to_route("articles.table")->with("status", "Article {$article->title} has been {$action}");
    }

    public function index()
    {
        $articles = Article::latest('published_at')
            ->published()
            ->with(['category', 'tags', 'author'])->paginate(9);

        return view("articles.index", [
            "articles" => $articles,
        ]);
    }

    public function show(Request $request, Article $article)
    {
        Gate::authorize('viewIfOnlyAuthorOrAdmin', $article);

        // $isLiked = Like::query()->whereMorphedTo('likeable', $article)->where('user_id', $request->user()?->id)->count();
        // $likesCount = Like::query()->whereMorphedTo('likeable', $article)->count();


        $relatedArticles = Article::where('category_id', $article->category_id)
            ->whereNot('id', $article->id)
            ->published()
            ->latest()
            ->limit(10)
            ->get();

        $comments = Comment::query()
            ->select('id', 'user_id', 'created_at', 'body')
            ->with('user')
            ->withCount('likes')
            ->whereMorphedTo('commentable', $article)->get();

        $article->loadCount('likes');
        return view('articles.show', compact('article', "relatedArticles", 'comments'));
    }

    public function create(Request $request)
    {
        $categories = $this->categories;
        $tags = $this->tags;
        $article = new Article();
        return view('articles.create', compact("categories", "article", "tags"));
    }

    public function store(ArticleRequest $request)
    {
        $image = $request->file("picture");

        $article = auth()->user()->articles()->create([
            "title" => $title = $request->title,
            "slug" => $slug = str($title . " " . str()->random(3))->slug(),
            "body" => $request->body,
            "category_id" => $request->category_id,
            "status" => "pending",
            "picture" => $image ?
                $image->storeAs("articles/images" . $slug . $image->extension()) : null,
        ]);

        $article->tags()->attach($request->tags);

        return to_route("articles.show", $article);
    }

    public function edit(Request $request, Article $article)
    {
        Gate::authorize('view', $article);

        $categories = $this->categories;
        $tags = $this->tags;
        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        Gate::authorize('update', $article);

        $fileRequest = $request->file("picture");

        $article->update([
            "title" => $request->title,
            "body" => $request->body,
            "category_id" => $request->category_id,
            "picture" => $fileRequest ?
                $fileRequest->storeAs("articles/images" . $article->slug . $fileRequest->extension())
                : $article->picture,
        ]);

        $article->tags()->sync($request->tags);

        return to_route("articles.show", $article);
    }

    public function destroy(Request $request, Article $article)
    {
        Gate::authorize('delete', $article);

        if ($article->picture) {
            Storage::delete($article->picture);
        }
        $article->tags()->detach();
        $article->delete();
        return back();
    }
}
