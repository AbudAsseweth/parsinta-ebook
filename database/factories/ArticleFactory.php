<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = str(str(fake()->sentence(4))->title())->replace(".", "");

        return [
            'title' => $title,
            'slug' => str($title . str()->random(6))->slug(),
            'body' => fake()->sentence(100),
            "created_at" => $created_at = now()->subDays(rand(1, 100)),
            "updated_at" => $created_at,
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (Article $article) {
            $article->category_id = rand(1, 4);
        });
    }
}
