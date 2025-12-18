<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Algemeen',
                'slug' => 'algemeen',
                'description' => 'Algemene vragen en informatie',
                'order' => 1,
            ],
            [
                'name' => 'Schoonmaak',
                'slug' => 'schoonmaak',
                'description' => 'Vragen over schoonmaakdiensten',
                'order' => 2,
            ],
            [
                'name' => 'Renovatie',
                'slug' => 'renovatie',
                'description' => 'Vragen over renovatieprojecten',
                'order' => 3,
            ],
            [
                'name' => 'Facturatie',
                'slug' => 'facturatie',
                'description' => 'Vragen over facturen en betalingen',
                'order' => 4,
            ],
            [
                'name' => 'Technisch',
                'slug' => 'technisch',
                'description' => 'Technische vragen en problemen',
                'order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
