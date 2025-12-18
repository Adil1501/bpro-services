<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        $services = [
            ['name' => 'Kantoor Schoonmaak', 'icon' => 'fa-building'],
            ['name' => 'Ramen Lappen', 'icon' => 'fa-window-maximize'],
            ['name' => 'Vloeren Reinigen', 'icon' => 'fa-broom'],
            ['name' => 'Post-Renovatie', 'icon' => 'fa-hammer'],
            ['name' => 'Diepe Reiniging', 'icon' => 'fa-spray-can'],
            ['name' => 'Schoonmaak bij verhuur en teruggave', 'icon' => 'fa-rental'],
        ];

        $service = fake()->unique()->randomElement($services);

        return [
            'name' => $service['name'],
            'slug' => Str::slug($service['name']),
            'description' => fake()->paragraph(3),
            'icon' => $service['icon'],
            'is_active' => fake()->boolean(95),
            'order' => fake()->numberBetween(1, 10),
        ];
    }
}
