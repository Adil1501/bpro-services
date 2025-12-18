<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    public function definition(): array
    {
        return [
            'question' => fake()->sentence() . '?',
            'answer' => fake()->paragraph(5),
            'order' => fake()->numberBetween(1, 20),
            'is_published' => fake()->boolean(90),
        ];
    }
}
