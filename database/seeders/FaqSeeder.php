<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->warn('Geen categorieën gevonden. FAQs overgeslagen.');
            return;
        }

        foreach ($categories as $category) {
            Faq::factory(rand(5, 10))->create([
                'category_id' => $category->id,
            ]);
        }

        $schoonmaakCategory = Category::where('slug', 'schoonmaak')->first();

        if ($schoonmaakCategory) {
            Faq::create([
                'category_id' => $schoonmaakCategory->id,
                'question' => 'Hoe vaak moet ik mijn kantoor laten schoonmaken?',
                'answer' => 'Dit hangt af van het aantal werknemers en de aard van uw bedrijf. Voor een gemiddeld kantoor adviseren wij 2-3 keer per week. Voor drukke kantoren of bedrijven met veel klantcontact raden wij dagelijkse schoonmaak aan.',
                'order' => 1,
                'is_published' => true,
            ]);

            Faq::create([
                'category_id' => $schoonmaakCategory->id,
                'question' => 'Welke producten gebruiken jullie?',
                'answer' => 'Wij gebruiken professionele, milieuvriendelijke schoonmaakproducten die effectief zijn en veilig voor mens en milieu. Al onze producten zijn gecertificeerd en voldoen aan de Europese normen.',
                'order' => 2,
                'is_published' => true,
            ]);
        }

        $this->command->info('✅ FAQs aangemaakt');
    }
}
