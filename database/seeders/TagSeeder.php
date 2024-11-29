<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['name' => $name = 'Laravel', 'slug' => str($name)->slug()],
            ['name' => $name = 'PHP', 'slug' => str($name)->slug()],
            ['name' => $name = 'React', 'slug' => str($name)->slug()],
            ['name' => $name = 'Inertia.js', 'slug' => str($name)->slug()],
            ['name' => $name = 'Tailwind CSS', 'slug' => str($name)->slug()]
        ])->each(fn($tag) => Tag::create($tag));
    }
}
