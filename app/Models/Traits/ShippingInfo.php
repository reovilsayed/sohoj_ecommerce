<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

trait ShippingInfo
{
    public function contains_battery_pi966()
    {
        return $this->parcels[0]['contains_battery_pi966'] ?? false;
    }

    public function contains_battery_pi967()
    {
        return $this->parcels[0]['contains_battery_pi967'] ?? false;
    }

    public function contains_liquids()
    {
        return $this->parcels[0]['contains_liquids'] ?? false;
    }

    public function origin_country_alpha2()
    {
        return $this->parcels[0]['origin_country_alpha2'] ?? '';
    }

    public function length()
    {
        return $this->parcels[0]['length'] ?? 25;
    }

    public function width()
    {
        return $this->parcels[0]['width'] ?? 25;
    }

    public function height()
    {
        return $this->parcels[0]['height'] ?? 25;
    }

    public function weight(){
        return $this->parcels[0]['actual_weight'] ?? 0.5;
    }

    public function hs_code(){
        return $this->parcels[0]['category_id'] ?? null;
    }

    public function category_id(){
        return (string) $this->parcels[0]['category_id'] ?? null;
    }

    public function description(){
        return $this->parcels[0]['description'] ?? '';
    }
    
}
