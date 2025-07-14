<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Shop;
use App\Models\Product;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [
            url('/'),
            route('shops'),
        ];

        foreach (Shop::all() as $shop) {
            $urls[] = route('store_front', $shop->slug);
        }
        foreach (Product::all() as $product) {
            $urls[] = route('product_details', $product->slug);
        }

        $xml = view('sitemap.xml', compact('urls'))->render();

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }
} 