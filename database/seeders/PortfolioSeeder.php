<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PortfolioProject;
use App\Models\User;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->warn('Geen categorieën gevonden. Portfolio projecten overgeslagen.');
            return;
        }

        foreach (range(1, 15) as $index) {
            $category = $categories->random();

            $project = PortfolioProject::factory()->create([
                'category_id' => $category->id,
            ]);

            $userCount = rand(0, 10);
            if ($userCount > 0) {
                $users = User::inRandomOrder()->limit($userCount)->get();
                $project->likes()->attach($users);
                $project->update(['likes_count' => $users->count()]);
            }
        }

        $this->command->info('✅ 15 portfolio projecten aangemaakt');
    }
}
