<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likeComments(Request $request, Comment $comment)
    {
        $request->user()?->toggleLike($comment);
        return back();
    }

    public function likeArticles(Request $request, Article $article)
    {
        $request->user()?->toggleLike($article);

        return back();
    }
}
