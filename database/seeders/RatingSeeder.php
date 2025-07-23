<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;
use App\Models\Product;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Str;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $users = User::all();
        $shops = Shop::all();

        foreach ($products as $product) {
            Rating::create([
                'product_id' => $product->id,
                'user_id'    => $users->random()->id,
                'shop_id'    => $shops->random()->id,
                'status'     => true,
                'name'       => fake()->name(),
                'email'      => fake()->safeEmail(),
                'rating'     => (string) rand(1, 5),
                'review'     => fake()->sentence(),
            ]);
        }
    }
}

