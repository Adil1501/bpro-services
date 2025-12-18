<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ServiceSeeder::class,
            TagSeeder::class,
            FaqSeeder::class,
            NewsSeeder::class,
            PortfolioSeeder::class,
            QuoteSeeder::class,
            ContactMessageSeeder::class,
            TicketSeeder::class,
        ]);

        $this->command->info('✅ Database seeding compleet!');
        $this->command->info('📊 Check je data in phpMyAdmin');
    }
}
