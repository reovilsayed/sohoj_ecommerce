<?php

namespace App\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;


class Settings
{
    public static function setting($key, $default = null)
    {
        // return $key;
        $setting = Setting::where('key', $key)->first();

        if ($setting && $setting->type === 'file') {
            return Storage::url($setting->data ?? '') ?: $default;
        }

        return $setting->value ?? $default;
    }
}
