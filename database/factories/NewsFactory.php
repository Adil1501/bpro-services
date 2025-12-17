<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'author_id' => User::where('role', 'admin')->inRandomOrder()->first()->id ?? User::factory(),
            'title' => rtrim($title, '.'),
            'slug' => Str::slug($title),
            'image' => 'news/' . fake()->numberBetween(1, 10) . '.jpg',
            'excerpt' => fake()->sentence(15),
            'content' => fake()->paragraphs(8, true),
            'published_at' => fake()->dateTimeBetween('-3 months', 'now'),
            'is_published' => fake()->boolean(85),
        ];
    }
}
