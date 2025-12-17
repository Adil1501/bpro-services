<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Schoonmaak',
            'Renovatie',
            'Ramen',
            'Vloeren',
            'Kantooronderhoud',
            'Post-bouw reiniging',
            'Diepe reiniging',
            'Huurinkomsten/uitgaven',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(12),
            'order' => fake()->numberBetween(1, 10),
        ];
    }
}
