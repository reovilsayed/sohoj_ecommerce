<?php

namespace App\Services\Shipping;

use Illuminate\Support\Facades\Http;

class EashShipProvider
{

    private $accessToken;
    private $endpoint = "https://public-api.easyship.com/2024-09/";

    public function __construct()
    {
        $this->setAccessToken();
    }

    private function setAccessToken()
    {
        $this->accessToken =  config('services.eash_ship.access_token');
    }

    public function getRatesPayload()
    {
        return [
            "origin_address" => [
                "line_1" => "2251 SW Binford Lake Parkway",
                "line_2" => "Gresham",
                "state" => "OR",
                "city" => "Gresham",
                "postal_code" => "97080",
                "country_alpha2" => "US",
                "company_name" => "Afrikartt",
                "contact_name" => "Afrikartt",
                "contact_phone" => "555-123-4567",
                "contact_email" => "info@afrikartt.com",
            ],
            "destination_address" => [
                "city" => "Wasilla",
                "company_name" => "",
                "contact_email" => "thisiskazi@gmail.com",
                "contact_name" => "Kazi Thabit",
                "contact_phone" => "808-852-5935",
                "country_alpha2" => "US",
                "line_2" => "940 Goldendale Dr",
                "line_1" => "940 Goldendale Dr, Wasilla, Alaska 99654, USA",
                
                "postal_code" => "99654",
                "state" => "AK"
            ],
            "set_as_residential" => true,
            "incoterms" => "DDP",
            "courier_settings" => [
                "show_courier_logo_url" => true,
                "apply_shipping_rules" => false
            ],
            "shipping_settings" => [
                "units" => [
                    "weight" => "kg",
                    "dimensions" => "cm"
                ],
                "output_currency" => "USD"
            ],
            "parcels" => [
                [
                    "box" => null,
                    "total_actual_weight" => 5,

                    "items" => [
                        [
                            "hs_code" => "91021900",
                            "contains_battery_pi966" => true,
                            "contains_battery_pi967" => true,
                            "contains_liquids" => true,
                            "origin_country_alpha2" => "US",
                            "quantity" => 1,
                            "declared_currency" => "USD",

                            "declared_customs_value" => 1,
                            "actual_weight" => 5.0,
                            "dimensions" => [
                                "length" => 25.00,
                                "width" => 25.0,
                                "height" => 25.0
                            ],
                        ]

                    ]
                ]
            ]
        ];
    }

    public function getRates()
    {

        $payload = $this->getRatesPayload();

        $response = Http::withHeaders([
            'authorization' => 'Bearer ' . $this->accessToken,
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->post($this->endpoint . 'rates', $payload);

        return $response->json();
    }

    public function getCategories()
    {
        $response = Http::withHeaders([
            'authorization' => 'Bearer ' . $this->accessToken,
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->get($this->endpoint . 'item_categories');

        return $response->json();
    }


   
}
