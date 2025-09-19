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
        $this->accessToken = (config('services.eash_ship.mode') == 'sandbox' ?  "sand_" : "prod_") . config('services.eash_ship.access_token');
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
                "city" => "London",
                "company_name" => "Test Plc.",
                "contact_email" => "asd@asd.com",
                "contact_name" => "Foo Bar",
                "contact_phone" => "+85230085678",
                "country_alpha2" => "GB",
                "line_1" => "30 Bond Street",
                "line_2" => "Flat 3",
                "postal_code" => "W1 5AA",
                "state" => null
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
                    "total_actual_weight" => 1,

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
                            "actual_weight" => 1,
                            "dimensions" => [
                                "length" => 1,
                                "width" => 1,
                                "height" => 1
                            ],
                        ]

                    ]
                ]
            ]
        ];
    }

    public function getRates()
    {

        dd($this->accessToken);
        $payload = $this->getRatesPayload();

        $response = Http::withHeaders([
            'authorization' => 'Bearer ' . $this->accessToken,
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->post($this->endpoint . 'rates', $payload);

        return $response->json();
    }


    public function validateAddress($companyName, $line1, $line2 = null, $city, $state, $postalCode, $countryAlpha2,)
    {
        $response = Http::withHeaders([
            'authorization' => 'Bearer ' . $this->accessToken,
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->post($this->endpoint . 'addresses/validations', [
            "company_name" => $companyName,
            "line_1" => $line1,
            "line_2" => $line2,
            "city" => $city,
            "state" => $state,
            "postal_code" => $postalCode,
            "country_alpha2" => $countryAlpha2,
        ]);

        return $response->json();
    }
}
