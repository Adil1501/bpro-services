<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        try {
            return Setting::get($key, $default);
        } catch (\Exception $e) {
            return $default;
        }
    }
}
