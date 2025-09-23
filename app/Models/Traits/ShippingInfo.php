<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

trait ShippingInfo
{
    public function contains_battery_pi966()
    {
        return true;
    }

    public function contains_battery_pi967()
    {
        return true;
    }

    public function contains_liquids()
    {
        return true;
    }

    public function origin_country_alpha2()
    {
        return 'US';
    }

    public function length()
    {
        return 25;
    }

    public function width()
    {
        return 25;
    }

    public function height()
    {
        return 25;
    }

    public function weight(){
        return 5;
    }

    public function hs_code(){
        return '91021900';
    }
}
