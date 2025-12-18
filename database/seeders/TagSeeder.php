<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Tips',
            'Nieuws',
            'Promotie',
            'Schoonmaak',
            'Renovatie',
            'Duurzaamheid',
            'Innovatie',
            'Klantervaring',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag),
            ]);
        }
    }
}
