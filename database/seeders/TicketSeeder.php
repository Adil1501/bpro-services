<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $users = User::where('role', 'user')->get();
        $admins = User::where('role', 'admin')->get();

        if ($categories->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Geen categorieën of users gevonden. Tickets overgeslagen.');
            return;
        }

        foreach (range(1, 20) as $index) {
            $user = $users->random();
            $category = $categories->random();
            $hasAssignment = fake()->boolean(60);

            $ticket = Ticket::factory()->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'assigned_to' => $hasAssignment && $admins->isNotEmpty()
                    ? $admins->random()->id
                    : null,
            ]);

            $replyCount = rand(1, 5);

            for ($i = 0; $i < $replyCount; $i++) {
                $isAdminReply = ($i % 2 === 1);

                TicketReply::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $isAdminReply && $admins->isNotEmpty()
                        ? $admins->random()->id
                        : $ticket->user_id,
                    'message' => fake()->paragraph(3),
                ]);
            }
        }

        $this->command->info('✅ 20 tickets met replies aangemaakt');
    }
}
