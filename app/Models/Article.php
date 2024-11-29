<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use App\Traits\HasLike;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Article extends Model
{
    use HasFactory, HasLike;

    protected $guarded = [
        "id",
    ];

    protected function casts(): array
    {
        return [
            "status" => ArticleStatus::class,
        ];
    }

    public function getRouteKeyName(): string
    {
        return "slug";
    }

    public function isStatus($status)
    {
        return $this->status == ArticleStatus::{$status};
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('published_at', "!=", null);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
