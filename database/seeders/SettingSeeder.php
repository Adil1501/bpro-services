<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            ['key' => 'site_name', 'value' => 'B-Pro Services', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Professionele Schoonmaakdiensten', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'B-Pro Services levert professionele schoonmaakdiensten voor bedrijven en particulieren.', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'info@bproservices.be', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+32 123 45 67 89', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Diestsestraat 123', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_city', 'value' => 'Leuven', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_postal_code', 'value' => '3000', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'business_vat', 'value' => 'BE 0123.456.789', 'type' => 'text', 'group' => 'business'],
            ['key' => 'business_kvk', 'value' => '0123.456.789', 'type' => 'text', 'group' => 'business'],
        ];

        foreach ($defaults as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
