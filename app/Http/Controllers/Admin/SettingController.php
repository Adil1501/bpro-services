<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::getAllAsArray();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'site_description' => ['nullable', 'string', 'max:500'],
            'contact_email' => ['required', 'email'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_address' => ['nullable', 'string', 'max:255'],
            'contact_city' => ['nullable', 'string', 'max:100'],
            'contact_postal_code' => ['nullable', 'string', 'max:20'],
            'business_vat' => ['nullable', 'string', 'max:50'],
            'business_kvk' => ['nullable', 'string', 'max:50'],
            'social_facebook' => ['nullable', 'url'],
            'social_instagram' => ['nullable', 'url'],
            'social_linkedin' => ['nullable', 'url'],
            'social_twitter' => ['nullable', 'url'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            if ($oldLogo = Setting::get('site_logo')) {
                Storage::disk('public')->delete($oldLogo);
            }

            $logoPath = $request->file('logo')->store('settings', 'public');
            Setting::set('site_logo', $logoPath, 'image', 'general');
        }

        foreach ($validated as $key => $value) {
            if ($key !== 'logo') {
                $group = $this->getSettingGroup($key);
                Setting::set($key, $value, 'text', $group);
            }
        }

        Setting::clearCache();

        return back()->with('success', 'Instellingen succesvol opgeslagen!');
    }

    private function getSettingGroup(string $key): string
    {
        if (str_starts_with($key, 'site_')) {
            return 'general';
        } elseif (str_starts_with($key, 'contact_')) {
            return 'contact';
        } elseif (str_starts_with($key, 'social_')) {
            return 'social';
        } elseif (str_starts_with($key, 'business_')) {
            return 'business';
        }

        return 'general';
    }
}
