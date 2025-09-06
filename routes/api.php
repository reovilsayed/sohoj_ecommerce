<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\VendorApiController;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/products', [ProductApiController::class, 'index']);
Route::get('/products/{product:slug}', [ProductApiController::class, 'show']);
Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/vendors', [VendorApiController::class, 'index']);
Route::get('/vendors/{shop:slug}', [VendorApiController::class, 'show']);
Route::get('vendor/{shop:slug}/products', [ProductApiController::class, 'vendorProducts']);

// Order and Checkout APIs
Route::post('/orders', [OrderApiController::class, 'store']);
Route::post('/orders/{order}/checkout', [OrderApiController::class, 'checkout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('order/checkout', CheckoutController::class);
    Route::delete('order/delete', [OrderApiController::class, 'deleteOrder']);
    Route::get('order/{order}/shipping-rates', [OrderApiController::class, 'getShippingRates']);
    Route::post('order/{order}/confirm', [OrderApiController::class, 'confirmOrder']);
});


