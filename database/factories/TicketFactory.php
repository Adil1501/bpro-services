<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition(): array
    {
        $subjects = [
            'Probleem met schoonmaak',
            'Vraag over factuur',
            'Product werkt niet goed',
            'Klacht over dienstverlening',
            'Wijziging afspraak',
            'Extra dienst aanvragen',
        ];

        return [
            'subject' => fake()->randomElement($subjects),
            'description' => fake()->paragraph(5),
            'priority' => fake()->randomElement(['low', 'medium', 'high', 'urgent']),
            'status' => fake()->randomElement(['open', 'in_progress', 'resolved', 'closed']),
            'attachment' => fake()->boolean(30) ? 'tickets/' . fake()->uuid() . '.jpg' : null,
        ];
    }
}
