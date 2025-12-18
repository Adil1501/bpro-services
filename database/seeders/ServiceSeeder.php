<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Kantoor Schoonmaak',
                'slug' => 'kantoor-schoonmaak',
                'description' => 'Professionele schoonmaak van kantoorruimtes, inclusief bureau\'s, sanitair en gemeenschappelijke ruimtes.',
                'icon' => 'fa-building',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Ramen Lappen',
                'slug' => 'ramen-lappen',
                'description' => 'Streeploos ramen wassen voor een kristalheldere uitstraling van uw pand.',
                'icon' => 'fa-window-maximize',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Vloeren Reinigen',
                'slug' => 'vloeren-reinigen',
                'description' => 'Grondige reiniging en onderhoud van alle soorten vloeren.',
                'icon' => 'fa-broom',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Post-Renovatie Schoonmaak',
                'slug' => 'post-renovatie',
                'description' => 'Grondige eindschoonmaak na verbouwingen of renovaties.',
                'icon' => 'fa-hammer',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Diepe Reiniging',
                'slug' => 'diepe-reiniging',
                'description' => 'Intensieve schoonmaakbeurt voor grondig onderhoud.',
                'icon' => 'fa-spray-can',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Schoonmaak bij verhuur en teruggave',
                'slug' => 'schoonmaak huurinkomsten/uitgaven',
                'description' => 'Verhoog het rendement van uw huurwoning door professionele reiniging.',
                'icon' => 'fa-rental',
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
