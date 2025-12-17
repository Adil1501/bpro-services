<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Tips',
            'Nieuws',
            'Promotie',
            'Schoonmaak',
            'Renovatie',
            'Duurzaamheid',
            'Innovatie',
            'Klantervaring',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
