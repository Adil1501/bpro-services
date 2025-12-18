<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioProjectFactory extends Factory
{
    public function definition(): array
    {
        $titles = [
            'Kantoor Renovatie Brussel',
            'Diepe Reiniging Antwerpen',
            'Ramen Project Gent',
            'Post-Bouw Schoonmaak Leuven',
            'Schoonmaak Huurinkomsten/Uitgaven Mechelen',
            'Vloer Renovatie Hasselt',
            'Showroom Schoonmaak Brugge',
            'Restaurant Diepreiniging Kortrijk',
            'Kantoor Glas Project Oostende',
            'Winkel Renovatie Turnhout',
        ];

        return [
            'title' => fake()->randomElement($titles) . ' #' . rand(1, 999),
            'description' => fake()->paragraph(4),
            'before_image' => 'portfolio/before-' . fake()->numberBetween(1, 10) . '.jpg',
            'after_image' => 'portfolio/after-' . fake()->numberBetween(1, 10) . '.jpg',
            'location' => fake()->city() . ', België',
            'completed_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'is_featured' => fake()->boolean(20),
            'likes_count' => 0,
        ];
    }
}
