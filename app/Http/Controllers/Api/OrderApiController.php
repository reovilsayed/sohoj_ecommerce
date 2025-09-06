<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Mail\AdminOrderPlacedMail;
use App\Mail\CustomarOrderPlacedMail;
use App\Mail\VendorOrderPlacedMail;
use App\Models\Order;
use App\Models\Product;
use App\Services\PaymentService;
use App\Services\UPSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Settings;

class OrderApiController extends Controller
{
    // Create a new order
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'               => 'required|exists:users,id',
            'products'              => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity'   => 'required|integer|min:1',
            'shipping'              => 'required|array',
            'billing'               => 'required|array',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        return DB::transaction(function () use ($request) {
            $order = Order::create([
                'user_id'  => $request->user_id,
                'shipping' => json_encode($request->shipping),
                'billing'  => json_encode($request->billing),
                'status'   => 'pending',
            ]);
            foreach ($request->products as $item) {
                $product = Product::find($item['product_id']);
                $order->products()->attach($product->id, [
                    'quantity'    => $item['quantity'],
                    'price'       => $product->price,
                    'total_price' => $product->price * $item['quantity'],
                ]);
            }
            $order->load('products');
            return (new OrderResource($order))->response()->setStatusCode(201);
        });
    }

    // Checkout (mark order as paid)
    public function checkout(Request $request, $orderId)
    {
        $order            = Order::findOrFail($orderId);
        $order->status    = 'paid';
        $order->date_paid = now();
        $order->save();
        $order->load('products');
        return (new OrderResource($order))->additional(['message' => 'Order checked out successfully']);
    }

    public function deleteOrder(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $order = Order::find($request->order_id);

        if ($order->user_id != auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        if ($order->status != 0) {
            return response()->json(['message' => 'Only pending orders can be deleted'], 400);
        }
        foreach ($order->childs as $childOrder) {
            $childOrder->delete();
        }
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully'], 200);
    }

    public function getShippingRates(Order $order)
    {

        $shipping = json_decode($order->shipping, true);
        $packages = $order->products->map(function ($product) {
            return [
                'length' => $product->length ?? 10,
                'width'  => $product->width ?? 8,
                'height' => $product->height ?? 4,
                'weight' => $product->weight ?? 2,
            ];
        })->toArray();

        $rates = (new UPSService())->getRates(toAddress: [
            'name'         => $shipping['firstName'] . ' ' . $shipping['lastName'],
            'address_line' => $shipping['address_line'],
            'city'         => $shipping['city'],
            'state'        => $shipping['state_code'],
            'postal_code'  => $shipping['post_code'],
            'country_code' => $shipping['country_code'],
        ], fromAddress: [
            'name'         => 'Afrikartt',
            'address_line' => '2251 SW Binford Lake Parkway',
            'city'         => 'Gresham',
            'state'        => 'OR',
            'postal_code'  => '97080',
            'country_code' => 'US',
        ], packageDetails: $packages);

        return response()->json(['rates' => $rates]);
    }

    public function confirmOrder(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [

            'payment_method' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        $order->update([
            'payment_method' => $data['payment_method'],
        ]);

        $payment = new PaymentService(Order::find($order->id));
        $url     = $payment->getPaymentRedirectUrl();

        $shipping = json_decode($order->shipping, true);
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
        return response()->json(['redirect_url' => $url,'order'=>$order]);

      }
}
