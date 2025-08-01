<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        $products = ProductRepository::getAllProducts(20);
        return ProductResource::collection($products);
    }
}