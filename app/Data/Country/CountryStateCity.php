<?php

namespace App\Data\Country;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class CountryStateCity
{

    private $data;

    public function __construct()
    {
        $this->data = Cache::remember('country_state_city_data', 3600, function () {
            $path = public_path('json/countries_states_cities.json');
            return new Collection((array) json_decode(File::get($path), true));
        });
    }

    public function countryDetails($country)
    {
        return Cache::remember("country_state_city:country_details:{$country}", 3600, function () use ($country) {
            return $this->data->where('id', $country)->first();
        });
    }
    public function stateDetails($country, $state)
    {
        return Cache::remember("country_state_city:state_details:{$country}:{$state}", 3600, function () use ($country, $state) {
            $countryRow = $this->data->firstWhere('id', (int) $country);
            if (!$countryRow) return null;
            $states = new Collection($countryRow['states'] ?? []);
            return $states->firstWhere('id', (int) $state);
        });
    }
    public function cityDetails($country, $state, $city)
    {
        return Cache::remember("country_state_city:city_details:{$country}:{$state}:{$city}", 3600, function () use ($country, $state, $city) {
            $countryRow = $this->data->firstWhere('id', (int) $country);
            if (!$countryRow) return null;
            $states = new Collection($countryRow['states'] ?? []);
            $stateRow = $states->firstWhere('id', (int) $state);
            if (!$stateRow) return null;
            $cities = new Collection($stateRow['cities'] ?? []);
            return $cities->firstWhere('id', (int) $city);
        });
    }

    public function countries()
    {
        return Cache::remember('country_state_city:countries', 3600, function () {
            return $this->data->pluck('name', 'id');
        });
    }

    public function states($country)
    {
        return Cache::remember("country_state_city:states:{$country}", 3600, function () use ($country) {
            $states = new Collection($this->data->where('id', $country)->pluck('states')->first());
            return $states->pluck('name', 'id');
        });
    }

    public function cities($country, $state)
    {
        return Cache::remember("country_state_city:cities:{$country}:{$state}", 3600, function () use ($country, $state) {
            $states = new Collection($this->data->where('id', $country)->pluck('states')->first());
            $cities = new Collection($states->where('id', $state)->pluck('cities')->first());
            return $cities->pluck('name', 'id');
        });
    }
}
