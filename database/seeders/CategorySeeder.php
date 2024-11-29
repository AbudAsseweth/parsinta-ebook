<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            ['name' => $name = 'Blog', 'slug' => str($name)->slug()],
            ['name' => $name = 'Tutorials', 'slug' => str($name)->slug()],
            ['name' => $name = 'News', 'slug' => str($name)->slug()],
            ['name' => $name = 'Packages', 'slug' => str($name)->slug()],
        ]);

        $categories->each(fn($category) => Category::create($category));
    }
}
