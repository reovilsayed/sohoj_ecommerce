<?php

namespace App\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class Settings
{
    public static function setting($key, $default = null)
    {
        $settings = cache()->remember('all_settings', 360, function () {
            return Setting::all()->keyBy('key');
        });

        $setting = $settings[$key] ?? null;

        if ($setting && $setting->type == 'file') {
            return Storage::url($setting->value);
        } elseif ($setting) {
            return $setting->value;
        } else {
            return $default;
        }
    }
}
