<?php

namespace App\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class Settings
{
    public static function setting ($key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();
        
    
        if($setting && $setting->type == 'file'){
           return Storage::url($setting->value);
        }else{
            return $setting->value ?? '';
        }
    }

}
