<?php

use App\Data\Country\Africa;
use App\Data\Country\CountryStateCity;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VendorRegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MassageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PayoutsController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\RegistrationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Seller\SellerPagesController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\EmailVerified;
use App\Mail\OfferEmail;
use App\Mail\OrderPlaced;
use App\Mail\ShopCreatedEmail;
use App\Mail\TicketPlaced;
use App\Mail\VerifyEmail;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Page;
use App\Models\Shop;
use App\Models\Ticket;
use App\Models\User;
use App\Services\PaymentService;
use App\Services\UPSService;
use App\Setting\SettingsFacade as Settings;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Stripe\Price;
use Stripe\Product;
use Stripe\Stripe;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/vendors', [PageController::class, 'vendors'])->name('vendors');

Route::any('/get-state', [PageController::class, 'getShops']);

Route::post('follow/{shop}', [PageController::class, 'follow'])->name('follow');
Route::get('liked/shops', [PageController::class, 'followShops'])->name('follow.shops');

Route::post('/add-address', [CheckoutController::class, 'userAddress'])->name('user.address.store');


Route::get('/', [PageController::class, 'home'])->name('homepage');
Route::get('/shops', [PageController::class, 'shops'])->name('shops');
Route::get('/cart', [PageController::class, 'cart'])->name('cart');

Route::get('/product/{slug}', [PageController::class, 'product_details'])->name('product_details');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
// Route::get('/order_page', [PageController::class, 'order_page'])->name('order_page');
Route::get('/verify-email', [HomeController::class, 'verifyMassage'])->name('verify.massage');
Route::get('/thankyou', [PageController::class, 'thankyou'])->name('thankyou');

Route::post('/subscribe', [PageController::class, 'subscribe'])->name('subscribe');
Route::get('/quickview', [PageController::class, 'quickview'])->name('quickview');
Route::post('/offer/{product}', [HomeController::class, 'offer'])->name('offer');
Route::get('/offer-to-cart', [CartController::class, 'offerToCart'])->name('offer.cart');
Route::get('/set-location', [PageController::class, 'setLocation'])->name('set.location');
Route::get('/location-reset', [PageController::class, 'locationReset'])->name('location.reset');
// Route::get('/location-search', [PageController::class, 'locationSearch'])->name('location.search');
Route::get('/location-search', [PageController::class, 'locationSearchQuery'])->name('location.search.query');





// Wishlist 
Route::get('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::get('/wishlist/remove/{productId}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::get('wishlist-to-cart/{product_id}', [WishlistController::class, 'wishlistToCart'])->name('wishlistToCart');

//cart
Route::post('/add-cart', [CartController::class, 'add'])->name('cart.store');
Route::post('/buynow', [CartController::class, 'buynow'])->name('cart.boynow');
Route::post('/add-update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart-destroy/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/cart-qty', [CartController::class, 'cartQty'])->name('cart.qty');

// Basic connectivity & token test
Route::get('/ups/test', function () {
    try {
        $ups = new UPSService();
        $token = $ups->getAccessToken();

        return response()->json([
            'success' => true,
            'message' => 'UPS Service is working!',
            'token_preview' => substr($token, 0, 20) . '...'
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
})->name('ups.test');

// Example Rates request
Route::get('/ups/rates', function () {
    try {
        $ups = new UPSService();

        $fromAddress = [
            'name' => 'Sender Company',
            'address_line' => '55 Glenlake Parkway',
            'city' => 'Atlanta',
            'state' => 'GA',
            'postal_code' => '30328',
            'country_code' => 'US',
        ];

        $toAddress = [
            'name' => 'Recipient Name',
            'address_line' => '1 Infinite Loop',
            'city' => 'Cupertino',
            'state' => 'CA',
            'postal_code' => '95014',
            'country_code' => 'US',
        ];

        $packageDetails = [
            'length' => 10,
            'width' => 8,
            'height' => 4,
            'weight' => 2,
            'description' => 'Sample package',
        ];

        $rates = $ups->getRates($fromAddress, $toAddress, $packageDetails);

        return response()->json([
            'success' => true,
            'rates' => $rates,
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
})->name('ups.rates');

// Create a shipment and return label details (test)
Route::get('/ups/ship', function () {
    try {
        $ups = new UPSService();

        // Static test addresses - no environment variables
        $fromAddress = [
            'name'           => 'UPS Headquarters',
            'attention_name' => 'UPS Customer Service',
            'phone'          => '800-742-5877',
            'address_line'   => '55 Glenlake Parkway NE',
            'city'           => 'Atlanta',
            'state'          => 'GA',
            'postal_code'    => '30328',
            'country_code'   => 'US',
        ];

        $toAddress = [
            'name'           => 'Apple Inc.',
            'attention_name' => 'Apple Customer Service',
            'phone'          => '408-996-1010',
            'address_line'   => '1 Apple Park Way',
            'city'           => 'Cupertino',
            'state'          => 'CA',
            'postal_code'    => '95014',
            'country_code'   => 'US',
        ];

        $packageDetails = [
            'length' => 10.0,
            'width' => 8.0,
            'height' => 4.0,
            'weight' => 2.0,
            'description' => 'Test Package',
        ];

        // Service codes: 03 = Ground, 02 = 2nd Day Air, etc.
        $serviceCode = request('service', '03');

        // Log the addresses being used for debugging
        Log::info('UPS Shipment Request', [
            'from_address' => $fromAddress,
            'to_address' => $toAddress,
            'package_details' => $packageDetails,
            'service_code' => $serviceCode
        ]);

        $shipment = $ups->createShipment($fromAddress, $toAddress, $packageDetails, $serviceCode);

        return response()->json([
            'success' => true,
            'shipment' => $shipment,
        ]);
    } catch (Exception $e) {
        Log::error('UPS Shipment Error', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
})->name('ups.ship');

// Debug route to check UPS environment variables
Route::get('/ups/debug', function () {
    $envVars = [
        'UPS_FROM_NAME' => env('UPS_FROM_NAME'),
        'UPS_FROM_STATE' => env('UPS_FROM_STATE'),
        'UPS_FROM_CITY' => env('UPS_FROM_CITY'),
        'UPS_FROM_POSTAL_CODE' => env('UPS_FROM_POSTAL_CODE'),
        'UPS_TO_NAME' => env('UPS_TO_NAME'),
        'UPS_TO_STATE' => env('UPS_TO_STATE'),
        'UPS_TO_CITY' => env('UPS_TO_CITY'),
        'UPS_TO_POSTAL_CODE' => env('UPS_TO_POSTAL_CODE'),
        'UPS_CLIENT_ID' => env('UPS_CLIENT_ID') ? 'SET' : 'NOT SET',
        'UPS_CLIENT_SECRET' => env('UPS_CLIENT_SECRET') ? 'SET' : 'NOT SET',
        'UPS_ACCOUNT_NUMBER' => env('UPS_ACCOUNT_NUMBER') ? 'SET' : 'NOT SET',
    ];

    return response()->json([
        'environment_variables' => $envVars,
        'note' => 'Check your .env file to ensure UPS_FROM_STATE and UPS_TO_STATE are valid US state codes (e.g., GA, CA, NY, etc.)'
    ]);
})->name('ups.debug');

// Track a shipment
Route::get('/ups/track/{tracking}', function ($tracking) {
    try {
        $ups = new UPSService();
        $result = $ups->trackShipment($tracking);

        return response()->json([
            'success' => true,
            'tracking' => $result,
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
})->name('ups.track');

// Schedule a pickup
Route::post('/ups/pickup', function () {
    try {
        $ups = new UPSService();

        $pickupAddress = [
            'name' => env('UPS_FROM_NAME', 'Sender Company'),
            'phone' => env('UPS_FROM_PHONE', '1234567890'),
            'address_line' => env('UPS_FROM_ADDRESS', '55 Glenlake Parkway'),
            'city' => env('UPS_FROM_CITY', 'Atlanta'),
            'state' => env('UPS_FROM_STATE', 'GA'),
            'postal_code' => env('UPS_FROM_POSTAL_CODE', '30328'),
            'country_code' => env('UPS_FROM_COUNTRY_CODE', 'US'),
        ];

        $packageDetails = [
            'length' => env('UPS_PKG_LENGTH', 10),
            'width' => env('UPS_PKG_WIDTH', 8),
            'height' => env('UPS_PKG_HEIGHT', 4),
            'weight' => env('UPS_PKG_WEIGHT', 2),
        ];

        $pickupDateTime = request('when', env('UPS_PICKUP_DATETIME', date('Y-m-d 10:00:00', strtotime('+1 day'))));

        $result = $ups->schedulePickup($pickupAddress, $packageDetails, $pickupDateTime);

        return response()->json([
            'success' => true,
            'pickup' => $result,
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
})->name('ups.pickup');
//coupon routes
Route::post('/add-coupon', [CouponController::class, 'add'])->name('coupon');
Route::get('/delete-coupon', [CouponController::class, 'destroy'])->name('coupon.destroy');


Route::group(['prefix' => 'checkout'], function () {
    Route::get('/add-billing-and-shipping-information', [CheckoutController::class, 'shippingAndBillingInformationPage'])->name('checkout.index');
    Route::post('/store-billing-and-shipping-information', [CheckoutController::class, 'storeBillingAndShippingInformation'])->name('checkout.storeBillingAndShippingInformation');
    Route::get('{order}/payment', [CheckoutController::class, 'paymentPage'])->name('checkout.paymentPage');
    Route::post('{order}/confirm-order', [CheckoutController::class, 'confirmOrder'])->name('checkout.confirmOrder');
});

Route::get('/test/{order}/shipment', function (Order $order) {
    $ups = new UPSService();
    $shipping = json_decode($order->shipping, true);
    $packages =  $order->products->map(function ($product) {
        return [
            'length' => $product->length ?? 10,
            'width' => $product->width ?? 8,
            'height' => $product->height ?? 4,
            'weight' => $product->weight ?? 2,
        ];
    })->toArray();
    $result =   $ups->createShipment(
        toAddress: [
            'name' => $shipping['firstName'] . ' ' . $shipping['lastName'],
            'address_line' => $shipping['address_line'],
            'city' => $shipping['city'],
            'state' => $shipping['state_code'],
            'postal_code' => $shipping['post_code'],
            'country_code' => $shipping['country_code'],
            'phone' => $shipping['phone'],
        ],
        fromAddress: [
            'name' => 'Afrikartt',
            'address_line' => '55 Glenlake Parkway',
            'city' => 'Atlanta',
            'state' => 'GA',
            'postal_code' => '30328',
            'country_code' => 'US',
            'phone' => '800-742-5877',
        ],
        packageDetails: $packages,
        serviceCode: $order->shipping_method
    );
})->name('checkout.test');
//checkout routes
Route::post('/store-checkout', [CheckoutController::class, 'store'])->name('checkout.store');

//Rating
Route::post('rating/{product_id}', [PageController::class, 'rating'])->name('rating');
// Route::get('/profile/{slug}', [PageController::class, 'store_front'])->name('store_front');
Route::get('/store/{shop:slug}', [PageController::class, 'store_front'])->name('store_front');

Route::get('/seller', [SellerPagesController::class, 'dashboard'])->middleware('role:vendor')->name('dashboard');


// Route::group(['prefix' => 'admin'], function () {
//     Voyager::routes();
// });
Auth::routes();

// Redirect /vendor to /vendor/dashboard
// Route::get('/vendor', function () {
//     return redirect('/vendor');
// })->middleware('auth', 'role:vendor');

Route::get('admin/payout/{order}', [PayoutsController::class, 'payouts'])->name('payout')->middleware('auth', 'role:admin');

Route::get('admin/order/canceled', [PayoutsController::class, 'cancel_order'])->name('cancel.order')->middleware('auth', 'role:admin');
Route::get('admin/order/refund', [PayoutsController::class, 'refund'])->name('refund.order')->middleware('auth', 'role:admin');
Route::post('/refund/store', [PayoutsController::class, 'refund_store'])->name('refund.store');

// Route::get('/vendor-register', [RegisterController::class, 'vendorCreate'])->name('vendor.create');
// Route::post('/vendor-store', [VendorRegisterController::class, 'register'])->name('vendor.register.store');

// New comprehensive vendor registration form
Route::get('/vendor-registration', [PageController::class, 'vendorRegistration'])->name('vendor.registration');
Route::post('/vendor-registration', [PageController::class, 'vendorRegistrationStore'])->name('vendor.registration.store');
Route::get('/vendor-register-2nd-step', [HomeController::class, 'vendorSecondStep'])->name('vendor.second.step');
Route::post('/2nd-step-store', [HomeController::class, 'vendorSecondStepStore'])->name('vendor.second.step.store');

// Store Profile Setup Routes
Route::get('/store-profile-setup', [HomeController::class, 'storeProfileSetup'])->name('store.profile.setup')->middleware(['auth']);
Route::post('/store-profile-store', [HomeController::class, 'storeProfileStore'])->name('store.profile.store')->middleware(['auth']);

// Check Shop Status Route
Route::get('/check-shop-status', [HomeController::class, 'checkShopStatus'])->name('check.shop.status')->middleware(['auth']);

Route::get('/shop', [SellerPagesController::class, 'shop'])->name('vendor.shop')->middleware(['auth', 'verifiedEmail', 'second']);
Route::post('/store-shop', [SellerPagesController::class, 'shopStore'])->middleware('auth', 'verifiedEmail', 'second')->name('vendor.store');

Route::get('/shop/set-up-payment-method', [PaymentsController::class, 'setUpPaymentMethod'])->middleware('auth', 'verifiedEmail', 'second')->name('vendor.setUpPaymentMethod');
Route::get('/admin/orders/details/{order}', [AdminController::class, 'orderDetails'])->name('admin.order.details')->middleware('auth', 'role:admin');

Route::get('email/{offer}', function (Offer $offer) {
    return new OfferEmail($offer);
});


Route::get('verify/email', [HomeController::class, 'verifyEmail'])->name('verify.token');
Route::get('/agian/verify/email', [HomeController::class, 'againVerifyEmail'])->name('again.verify.token');

Route::get('page/{slug}', [PageController::class, 'getPage']);

Route::get('/order/seen', [SellerPagesController::class, 'orderSeen'])->name('order.seen');

Route::post('vendor/tickets/{ticket}', [TicketsController::class, 'reply'])->name('ticket.reply');
Route::get('ticket/{ticket}', [TicketsController::class, 'show'])->name('ticket.show');
Route::get('ticket/close/{ticket}', [TicketsController::class, 'close'])->name('ticket.close');

Route::get('/vendor/settings', [SellerPagesController::class, 'setting'])->name('vendor.settings');
Route::get('/seen/{notification}', [MassageController::class, 'seen'])->name('massage.seen');
Route::get('/massage/{id?}', [MassageController::class, 'create'])->name('massage.create')->middleware('auth');
Route::get('/massage/store/{id}', [MassageController::class, 'store'])->name('massage.store')->middleware('auth');
Route::post('vendor/vendor-profile-page', [SellerPagesController::class, 'logoCover'])->middleware('auth', 'verifiedEmail', 'second')->name('vendor.logo.cover');
Route::post('vendor/personal-info', [SellerPagesController::class, 'personalInfoUpdate'])->name('vendor.personal_info');
Route::post('/vendor/update-password', [SellerPagesController::class, 'updatePassword'])
    ->name('vendor.update_password');



Route::post('setting/bankInfo/update', [SellerPagesController::class, 'bankInfoUpdate'])->middleware('auth', 'verifiedEmail', 'second')->name('vendor.bankInfo.update');
Route::post('setting/generalInfo/update', [SellerPagesController::class, 'generalInfoUpdate'])->name('vendor.generalInfo.update');
Route::post('setting/shopAddress/update', [SellerPagesController::class, 'shopAddressUpdate'])->middleware('auth', 'verifiedEmail', 'second')->name('vendor.shopAddress.update');
Route::post('/shop/socialLink/store', [SellerPagesController::class, 'shopSocialLinksStore'])->name('vendor.shopSocialLinksStore.store')->middleware('auth', 'verifiedEmail', 'second');

Route::post('card/add', [SellerPagesController::class, 'cardAdd'])->name('user.card.add');
Route::group(['prefix' => 'admin', 'middleware' => 'admin.user'], function () {
    Route::get('/shop/{shop}/active', [HomeController::class, 'shopActive'])->name('admin.shop.active');
    Route::get('/shop/{shop}/freeforlife', [HomeController::class, 'freeforlife'])->name('admin.shop.freeforlife');
});

Route::get('hello/{order}', function (Order $order) {
    return new OrderPlaced($order, $order);
    // return  Mail::to($order->email)->send(new OrderPlaced($order));
});

Route::post('/admin/shops/{shop}/toggle-status', [AdminController::class, 'toggleShopStatus'])
    ->name('filament.admin.resources.shops.toggle-status')
    ->middleware(['auth', 'role:admin']);

Route::post('/status-update/{shop}', [PageController::class, 'shop_status_update'])->name('shop_status_update');

Route::post('settings/update', [PageController::class, 'settingsUpdate'])->middleware(['auth', 'role:admin'])->name('settings.update');


// Route::get('test',function(){
//     dd(settings::setting('site.description'));
// });

Route::get('faqs', [PageController::class, 'faqs'])->name('faqs');
Route::get('privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::post('contact', [PageController::class, 'contactStore'])->name('contact.store');
Route::get('payment/cancel', [PageController::class, 'paymentCancel'])->name('payment.cancel');
Route::get('why-sell-on-afrikart', [PageController::class, 'whySellOnAfrikart'])->name('why.sell.on.afrikart');
Route::get('sellers-helps', [PageController::class, 'sellersHelps'])->name('sellers.helps');
Route::get('/stripe/handle/{order}', [CheckoutController::class, 'handle'])->name('payment.handle');
Route::get('payment/handle/paypal/{order}', [CheckoutController::class, 'handlePaypal'])->name('payment.handle.paypal');

Route::post('vendor/signature', [SellerPagesController::class, 'signatureStore'])->name('vendor.signature');

Route::get('vendor/verification-pending', [SellerPagesController::class, 'verificationPending'])->name('vendor.verification');

Route::get('email', function () {
    return new ShopCreatedEmail(Shop::latest()->first());
});
// API Documentation Route
Route::get('/api-docs', function () {
    return view('pages.api-docs');
})->name('api.docs');

Route::get('test', function () {
    return Settings::setting('stripe_secret');
});

// Store selected country in session
Route::post('/set-country', function (Request $request) {
    $name = $request->input('name');
    $flag = $request->input('flag');
    if (!$name || !$flag) {
        return response()->json(['ok' => false, 'message' => 'Invalid payload'], 422);
    }
    session(['myCountry' => ['name' => $name, 'flag' => $flag]]);
    return response()->json(['ok' => true]);
})->name('set.country');




Route::group(['prefix' => 'register-as-seller'], function () {
    Route::get('/', [RegistrationController::class, 'basicInfo'])->name('vendor.create');
    Route::post('/store', [VendorRegisterController::class, 'register'])->name('vendor.register.store');
    Route::middleware(['auth', 'verifiedEmail'])->group(function () {
        Route::get('terms-and-conditions', [RegistrationController::class, 'termsAndConditions'])->name('vendor.registration.terms-and-conditions');
        Route::post('terms-and-conditions', [RegistrationController::class, 'termsAndConditionsStore'])->name('vendor.registration.terms-and-conditions.store');
        Route::get('/vendor-verification', [RegistrationController::class, 'vendorVerification'])->name('vendor.registration.verification');
        Route::post('/vendor-verification/store', [RegistrationController::class, 'vendorVerificationStore'])->name('vendor.registration.verification.store');
    });
});


Route::get('json/countries', function () {
    return (new CountryStateCity())->countries();
});
Route::get('json/states/{country}', function ($country) {
    return (new CountryStateCity())->states($country);
});
Route::get('json/cities/{country}/{state}', function ($country,$state) {
    return (new CountryStateCity())->cities($country,$state);
});