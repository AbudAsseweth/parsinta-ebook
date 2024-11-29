<?php

namespace Database\Seeders;

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(5)->hasArticles(15)->create();
        $tagsId = Tag::all()->pluck("id");

        Article::all()->each(
            fn($article) => $article->tags()->attach(
                $tagsId->random(rand(1, 5))
            )
        );

        Article::all()->random(60)->each(function ($article) {
            $article->update([
                "status" => ArticleStatus::APPROVED,
                "published_at" => now()->subDay(rand(1, 5)),
            ]);
        });

        Article::whereNull('status')->get()->each(function ($article) {
            $article->update([
                'status' => ArticleStatus::PENDING,
            ]);
        });
    }
}
