<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Shop;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        $products = ProductRepository::getAllProducts(20);
        return ProductResource::collection($products);
    }

    public function show(Product $product)
    {
        return ProductResource::make($product);
    }

    public function vendorProducts(Shop $shop, Request $request)
    {
        $products = ProductRepository::getVendorProducts($shop, $request->all());
        return ProductResource::collection($products);
    }
}