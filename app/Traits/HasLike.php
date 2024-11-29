<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasLike
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function alreadyLiked()
    {
        return $this->likes()->where("user_id", auth()->user()?->id)->exists();
    }
}
