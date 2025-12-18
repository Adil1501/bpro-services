<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{
    public function definition(): array
    {
        $hasUser = fake()->boolean(70);
        $service = Service::inRandomOrder()->first();

        return [
            'user_id' => $hasUser ? User::inRandomOrder()->first()?->id : null,
            'service_id' => $service ? $service->id : Service::factory(),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'company_name' => fake()->boolean(50) ? fake()->company() : null,
            'address' => fake()->address(),
            'surface_area' => fake()->numberBetween(50, 500),
            'preferred_date' => fake()->dateTimeBetween('now', '+2 months'),
            'message' => fake()->optional()->paragraph(),
            'status' => fake()->randomElement(['pending', 'reviewed', 'approved', 'rejected']),
            'admin_notes' => fake()->optional()->sentence(),
        ];
    }
}
