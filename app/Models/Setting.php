<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    public static function get(string $key, $default = null)
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            $setting = self::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public static function set(string $key, $value, string $type = 'text', string $group = 'general'): void
    {
        self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
            ]
        );

        Cache::forget("setting.{$key}");
    }

    public static function getAllAsArray(): array
    {
        return Cache::remember('settings.all', 3600, function () {
            return self::query()->pluck('value', 'key')->toArray();
        });
    }

    public static function clearCache(): void
    {
        Cache::forget('settings.all');

        foreach (self::query()->pluck('key') as $key) {
            Cache::forget("setting.{$key}");
        }
    }
}
