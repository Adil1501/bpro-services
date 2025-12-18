<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            $admin = User::factory()->create(['role' => 'admin']);
        }

        $tags = Tag::all();

        News::factory(20)->create([
            'author_id' => $admin->id,
        ])->each(function ($news) use ($tags) {
            $randomTags = $tags->random(rand(1, 3));
            $news->tags()->attach($randomTags);
        });
    }
}
