<?php

namespace App\Http\Controllers;

use App\Data\Country\CountryStateCity;
use App\Mail\AdminOrderPlacedMail;
use App\Mail\AdminOrderSuccessMail;
use App\Mail\CustomarOrderPlacedMail;
use App\Mail\CustomerOrderSuccessMail;
use App\Mail\VendorOrderPlacedMail;
use App\Mail\VendorOrderSuccessMail;
use App\Models\Address;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Services\Checkout\CheckoutService;
use App\Services\Checkout\Data\ShippingAndBillingInformation;
use App\Services\PaymentService;
use App\Services\UPSService;
use App\Setting\Settings;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;


class CheckoutController extends Controller
{

    public function shippingAndBillingInformationPage()
    {
        return view('pages.checkout');
    }
    public function storeBillingAndShippingInformation(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address_1' => 'required',

            'city' => 'required',
            'state' => 'required',

            'post_code' => 'required',
            'phone' => 'required',
            'country' => 'required',
        ]);


        try {
            DB::beginTransaction();

            $geo = new CountryStateCity();
            $country = $geo->countryDetails($request->country);
            $state   = $geo->stateDetails($request->country, $request->state);
            if (is_numeric($request->city)) {
                $city    = $geo->cityDetails($request->country, $request->state, $request->city);
            } else {
                $city = [
                    'name' => $request->city,
                ];
            }

            if (!$country) {
                DB::rollBack();
                return back()->withErrors(['country' => 'Selected country is invalid or unavailable.'])->withInput();
            }
            if (!$state) {
                DB::rollBack();
                return back()->withErrors(['state' => 'Selected state is invalid or unavailable for the chosen country.'])->withInput();
            }
            if (!$city) {
                DB::rollBack();
                return back()->withErrors(['city' => 'Selected city is invalid or unavailable for the chosen state.'])->withInput();
            }

            $shippingAndBillingInformation = new ShippingAndBillingInformation(
                firstName: $request->first_name,
                lastName: $request->last_name,
                email: $request->email,
                address_line: $request->address_1,
                latitude: $city['latitude'] ?? null,
                longitude: $city['longitude'] ?? null,
                city: $city['name'] ?? ($request->city ?? ''),
                state: $request->state,
                state_code: isset($state['iso2']) && strlen($state['iso2']) < 2 ? ($state['iso3166_2'] ?? $state['iso2']) : ($state['iso2'] ?? ''),
                state_name: $state['name'] ?? '',
                post_code: $request->post_code,
                phone: $request->phone,
                country_code: $country['iso2'] ?? '',
                country_name: $country['name'] ?? ''

            );

            $checkoutService = new CheckoutService($shippingAndBillingInformation);
            $order = $checkoutService->createOrder();



            // Post-commit actions
            $shipping = json_decode($order->shipping, true);
            $rates = (new UPSService())->getRates(toAddress: [
                'name' => $shipping['firstName'] . ' ' . $shipping['lastName'],
                'address_line' => $shipping['address_line'],
                'city' => $shipping['city'],
                'state' => $shipping['state_code'],
                'postal_code' => $shipping['post_code'],
                'country_code' => $shipping['country_code']
            ], fromAddress: [
                'name' => 'Afrikartt',
                'address_line' => '2251 SW Binford Lake Parkway',
                'city' => 'Gresham',
                'state' => 'OR',
                'postal_code' => '97080',
                'country_code' => 'US',
            ], packageDetails: $order->products->map(function ($product) {
                return [
                    'length' => $product->length ?? 10,
                    'width' => $product->width ?? 8,
                    'height' => $product->height ?? 4,
                    'weight' => $product->weight ?? 2,
                ];
            })->toArray());
            DB::commit();
            Cart::destroy();
            session()->forget('discount');
            session()->forget('discount_code');
            return redirect()->route('checkout.paymentPage', $order);
        } catch (\Throwable $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }
            return back()->withErrors(['checkout' => $e->getMessage()])->withInput();
        }
    }

    public function paymentPage(Order $order)
    {

        $shipping = json_decode($order->shipping, true);
        $packages =  $order->products->map(function ($product) {
            return [
                'length' => $product->length ?? 10,
                'width' => $product->width ?? 8,
                'height' => $product->height ?? 4,
                'weight' => $product->weight ?? 2,
            ];
        })->toArray();

        $rates = (new UPSService())->getRates(toAddress: [
            'name' => $shipping['firstName'] . ' ' . $shipping['lastName'],
            'address_line' => $shipping['address_line'],
            'city' => $shipping['city'],
            'state' => $shipping['state_code'],
            'postal_code' => $shipping['post_code'],
            'country_code' => $shipping['country_code']
        ], fromAddress: [
            'name' => 'Afrikartt',
            'address_line' => '2251 SW Binford Lake Parkway',
            'city' => 'Gresham',
            'state' => 'OR',
            'postal_code' => '97080',
            'country_code' => 'US',
        ], packageDetails: $packages);


        return view('pages.checkout-payment', ['order' => $order, 'rates' => $rates]);
    }

    public function confirmOrder(Order $order, Request $request)
    {
        $order->update([
            'shipping_method' => $request->selected_shipping_service,
            'shipping_total' => $request->selected_shipping_amount,
            'total' => $order->subtotal + $request->selected_shipping_amount - $order->discount,
            'payment_method' => $request->payment_method,
        ]);



        $shipping = json_decode($order->shipping, true);
        $payment = new PaymentService(Order::find($order->id));
        $url = $payment->getPaymentRedirectUrl();

        foreach ($order->childs as $childOrder) {
            if ($shipping['email']) {
                Mail::to($shipping['email'])->send(new CustomarOrderPlacedMail($order, $childOrder));
            }
            if (optional($childOrder->shop)->email) {
                Mail::to(optional($childOrder->shop)->email)->send(new VendorOrderPlacedMail($order, $childOrder));
            }
            if (Settings::setting('admin_email')) {
                Mail::to(Settings::setting('admin_email'))->send(new AdminOrderPlacedMail($order, $childOrder));
            }
        }
        return redirect($url);
    }



    public function store(Request $request)
    {

        $request->validate([
            // 'prevoius_address' => ['required'],
            'first_name' => ['required', 'max:40'],
            'last_name' => ['required', 'max:40'],
            'email' => ['required', 'max:40', 'email'],
            'terms' => ['required'],
            'payment_method' => 'required'
        ], [
            'prevoius_address.required' => 'You need to set a address first  by clicking "Add Address" bellow'
        ]);

        $shipping = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'post_code' => $request->post_code,
            'country' => $request->country,
            'state' => $request->state,
            'phone' => $request->phone,
            'shipping_method' => null,
            'shipping_url' => null,
        ];


        // try {
        $order = (new CheckoutService())->createOrder();
    }

    protected function decreaseQuantities()
    {
        foreach (Cart::getContent() as $item) {
            $varient = null;
            if (@$item->options['variation']) {
                $varient = $item->model->getVariationBySku($item->options['variation']);
            }

            if ($varient) {
                $varient->decreaseStock($item->qty);
            } else {

                $product = Product::find($item->model->id);
                $product->increment('total_sale');
                $product->update(['quantity' => $product->quantity - $item->qty]);
            }
        }
    }
    protected function notification($user, $shop)
    {
        Notification::create([
            'url' => env('APP_URL') . '/vendor/dashboard/orders/index',
            'title' => 'Order Created',
            'shop_id' => $shop,
        ]);
    }

    protected function productsAreNoLongerAvailable()
    {
        foreach (Cart::Content() as $item) {
            $product = Product::find($item->model->id);
            if ($product->quantity < $item->qty) {
                return true;
            }
        }
        return false;
    }
    public function userAddress(Request $request)
    {

        Address::create([
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'post_code' => $request->post_code,
            'user_id' => auth()->id(),
        ]);
        return redirect()->back()->with('success_msg', 'Address create successfull ');
    }

    public function handle(Order $order, Request $request)
    {
        $transactionId = $request->get('payment_intent');
        $order->update([
            'payment_status' => 1,
            'transaction_id' => $transactionId,
        ]);

        foreach ($order->childs as $childOrder) {
            $childOrder->update(['payment_status' => 1, 'transaction_id' => $transactionId]);
            Mail::to($childOrder->shop->email)->send(new VendorOrderSuccessMail($childOrder));
        }

        Mail::to(json_decode($order->shipping, true)['email'])->send(new CustomerOrderSuccessMail($order));
        if (Settings::setting('admin_email')) {
            Mail::to(Settings::setting('admin_email'))->send(new AdminOrderSuccessMail($order));
        }
        return redirect('/thankyou')->with('thank', 'Order Created successfully!');
    }

    public function handlePaypal(Order $order, Request $request)
    {
        $paypalOrderId = $request->query('token');
        $token = \App\Services\Payouts::token();

        $captureResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type'  => 'application/json',
        ])
            ->withBody('{}', 'application/json')
            ->post('https://api-m.sandbox.paypal.com/v2/checkout/orders/' . $paypalOrderId . '/capture');

        $paypalData = $captureResponse->json();

        $transactionId = $paypalData['purchase_units'][0]['payments']['captures'][0]['id'] ?? null;


        // Step 3: Save to DB
        $order->update([
            'payment_status' => 1,
            'transaction_id' => $transactionId,
        ]);
        foreach ($order->childs as $childOrder) {
            $childOrder->update(['payment_status' => 1, 'transaction_id' => $transactionId]);
            Mail::to($childOrder->shop->email)->send(new VendorOrderSuccessMail($childOrder));
        }

        Mail::to(json_decode($order->shipping, true)['email'])->send(new CustomerOrderSuccessMail($order));
        if (Settings::setting('admin_email')) {
            Mail::to(Settings::setting('admin_email'))->send(new AdminOrderSuccessMail($order));
        }

        return redirect('/thankyou')->with('thank', 'Order created and payment completed successfully!');
    }
}
