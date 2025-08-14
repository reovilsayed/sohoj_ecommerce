<?php

namespace App\Http\Controllers;

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
use App\Services\PaymentService;
use App\Setting\Settings;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;


class CheckoutController extends Controller
{
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

        if ($this->productsAreNoLongerAvailable()) {

            return back()->withErrors('Sorry! One of the items in your cart is no longer Available!');
        }
        // try {
        // DB::beginTransaction();
        $cartSubtotal = Cart::subtotalFloat() ?? 0;
        $platform_fee = \Sohoj::flatCommision($cartSubtotal) ?? 0;
        $shipping_cost = \Sohoj::shipping() ?? 0;
        $discount = (float) (\Sohoj::discount() ?? 0);
        $total = $cartSubtotal + $platform_fee + $shipping_cost - $discount;

        $order = Order::create([
            'user_id' => \auth()->check() ? \auth()->id() : null,
            'shop_id' => null,
            'product_id' => null,
            'shipping' => json_encode($shipping),
            'aptment' => $request->aptment,
            'subtotal' => $cartSubtotal,
            'discount' => \Sohoj::discount(),
            'discount_code' => \Sohoj::discount_code(),
            'tax' => null,
            'shipping_total' => \Sohoj::shipping(),
            'platform_fee' => $platform_fee,
            'total' => \Sohoj::newTotal(),
            'quantity' => null,
            'vendor_total' => null,
            'payment_method' => $request->payment_method,
        ]);
        foreach (Cart::Content() as $item) {
            $varient = null;
            if (@$item->options['variation']) {
                $varient = $item->model->getVariationBySku($item->options['variation']);
            }


            $vendor_price = $item->model->vendor_price;
            $shipping_cost = $item->model->shipping_cost;

            // Fallback to (price - 0.10) if vendor_price is null
            $vendor_price = $vendor_price ?? ($item->model->price - 0.10);

            if ($item->model->sale_price) {
                $flat_commision = $item->model->sale_price - $vendor_price;
            } else {
                $flat_commision = $item->model->price - $vendor_price;
            }
            OrderProduct::create([
                'quantity' => $item->qty,
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'price' => $item->price,
                'total_price' => $item->price * $item->qty,
                'variation' => $varient ? json_encode($varient->toArray()) : null,
                'shop_id' => $item->model->shop_id,
            ]);
            $childOrder = Order::create([
                'user_id' => \auth()->check() ? \auth()->id() : null,
                'parent_id' => $order->id,
                'shop_id' => $item->model->shop_id,
                'product_id' => $item->id,
                'shipping' => json_encode($shipping),
                'aptment' => $request->aptment,
                'subtotal' => floatval(str_replace(',', '', $item->price * $item->qty)),
                'discount' => \Sohoj::discount(),
                'discount_code' => null,
                'tax' => null,
                'shipping_total' => floatval(str_replace(',', '', $shipping_cost)),
                'platform_fee' => $flat_commision,
                'total' => floatval(str_replace(',', '', \Sohoj::round_num(($item->price * $item->qty) + $shipping_cost))),
                'quantity' => $item->qty,
                'vendor_total' => ($vendor_price  * $item->qty),
                'payment_method' => $request->payment_method,
                'product_price' => $item->price,
                // 'admin_tax'=> \Sohoj::taxCalculation($flat_commision) ?? 0,

            ]);

            OrderProduct::create([
                'quantity' => $item->qty,
                'order_id' => $childOrder->id,
                'product_id' => $item->model->id,
                'price' => $item->price,
                'total_price' => $item->price * $item->qty,
                'variation' => $varient ? json_encode($varient->toArray()) : null,
                'shop_id' => $item->model->shop_id,
            ]);

            $shipping = json_decode($childOrder->shipping, true);
            // dd($shipping);
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
        $paymentService = new PaymentService($order);
        $url = $paymentService->getPaymentRedirectUrl();
        Cart::destroy();
        session()->forget('discount');
        session()->forget('discount_code');
        return redirect($url);
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

        Mail::to($order->user->email)->send(new CustomerOrderSuccessMail($order));
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

        Mail::to($order->user->email)->send(new CustomerOrderSuccessMail($order));
        if (Settings::setting('admin_email')) {
            Mail::to(Settings::setting('admin_email'))->send(new AdminOrderSuccessMail($order));
        }

        return redirect('/thankyou')->with('thank', 'Order created and payment completed successfully!');
    }
}
