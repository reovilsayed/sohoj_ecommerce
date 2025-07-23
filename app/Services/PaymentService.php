<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Http;
use Exception;

class PaymentService
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function getPaymentRedirectUrl()
    {
        switch (strtolower($this->order->payment_method)) {
            case 'stripe':
                return $this->createStripeCheckoutLink();
            case 'paypal':
                return $this->createPayPalCheckoutLink();
            case 'cash':
                return route('thankyou');
            default:
                throw new Exception('Invalid payment method.');
        }
    }

    public function createStripeCheckoutLink()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems = [];

        if ($this->order->childs && $this->order->childs->count() > 0) {
            foreach ($this->order->childs as $orderProduct) {
                if (empty($orderProduct->Product) || empty($orderProduct->quantity)) {
                    continue;
                }
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $orderProduct->Product->name,
                        ],
                        'unit_amount' => intval($orderProduct->total * 100), // Stripe expects amount in cents
                    ],
                    'quantity' => $orderProduct->quantity,
                ];
            }
        } else {
            // Fallback for single-product order (no childs)
            if (!empty($this->order->Product) && !empty($this->order->quantity)) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $this->order->Product->name,
                        ],
                        'unit_amount' => intval($this->order->total * 100),
                    ],
                    'quantity' => $this->order->quantity,
                ];
            }
        }

        if (empty($lineItems)) {
            throw new \Exception('No products found for this order. Cannot create Stripe Checkout Session.');
        }

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'customer_email' => $this->order->shipping ? json_decode($this->order->shipping)->email : null,
            'success_url' => route('thankyou'),
            'cancel_url' => route('thankyou'),
            'metadata' => [
                'order_id' => $this->order->id,
            ],
        ]);
        return $session->url;
    }

    public function createPayPalCheckoutLink()
    {
        $client_id = 'ASEIeZ0uWYy1q8iGe-LJvFjRqVAK4wg5WtW5dFpKucIhhNFeutYGtiKV2M1kiLoGMb2T5CLmbXpN6Fgz';
        $secret_id = 'EN3248ng0HkjmIjwW3iEfxhQL8ll_YeHBoJsYzk-VgXKYgg6c-z8taDRJfn2OohnKdVK3o5m3cRGnM30';
        $endpoint = env('APP_ENV') === 'production'
            ? 'https://api-m.paypal.com/v2/checkout/orders'
            : 'https://api.sandbox.paypal.com/v2/checkout/orders';
        $token = \App\Services\Payouts::token();
        $body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => 'USD',
                    'value' => $this->order->total,
                ],
                'description' => 'Order #' . $this->order->id,
            ]],
            'application_context' => [
                'return_url' => route('thankyou'),
                'cancel_url' => route('thankyou'),
            ],
        ];
        $response = Http::withToken($token)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post($endpoint, $body);
        $data = $response->json();
        if (isset($data['links'])) {
            foreach ($data['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return $link['href'];
                }
            }
        }
        throw new Exception('Unable to create PayPal payment link.');
    }
}
