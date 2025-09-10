<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Mail\OfferEmail;
use App\Models\Address;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Prodcat;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopPolicy;
use App\Models\User;
use App\Models\Verification;
use App\Rules\MatchOldPassword;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Stripe\Charge;
use Stripe\Price;
use Stripe\Product as StripeProduct;
use Stripe\Stripe;

class SellerPagesController extends Controller
{
    public function dashboard()
    {
        $shop = auth()->user()->shop;
        $customer = User::filter()->get();

        $totalSell = Order::where('shop_id', $shop->id)->filter()->sum('total');
        $products = Product::whereNull('parent_id')->where('shop_id', $shop->id)
            ->when(request('product_search'), function ($query) {
                $query->where('name', 'LIKE', "%" . request('product_search') . "%");
            })->latest()->limit(5)->get();

        $latest_orders =  Order::where('shop_id', $shop ? $shop->id : ' ')
            ->when(request('order_search'), function ($query) {
                $query->where('name', 'LIKE', "%" . request('order_search') . "%");
            })->limit(5)->get();
        $offers = Offer::where('shop_id', $shop->id)->latest()->get();
        $last15daysorders = Order::where('shop_id', $shop->id)
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y")'))
            ->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as formatted_date'), DB::raw('count(*) as order_count'))
            ->get();






        return view('auth.seller.dashboard', compact('latest_orders', 'products', 'offers', 'totalSell', 'customer', 'last15daysorders'));
    }
    public function shop()
    {

        return view('auth.seller.shop_profile');
    }
    public function ordersIndex()
    {
        $latest_orders =  Order::where('shop_id', auth()->user()->shop->id)->latest()->get();

        return view('auth.seller.order.index', compact('latest_orders'));
    }
    public function orderView(Order $order)
    {


        return view('auth.seller.order.view', compact('order'));
    }
    public function returned_product_received(Order $order)
    {
        $order->returned_product_received = 1;
        $order->save();
        return back()->with('success_msg', 'Order update successfully');
    }
    public function invoice(Order $order)
    {

        return view('auth.seller.order.invoice', compact('order'));
    }
    public function setting()
    {

        $status = $this->subscriptionStatus();
        return view('auth.seller.setting', compact('status'));
    }
    function ChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success_msg', 'Password changed successfully');
    }
    public function shopStore(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:40'],
            'logo' => ['nullable'],
            'banner' => ['nullable'],
            'email' => ['required', 'max:40', 'email'],
            'phone' => ['required', 'max:40'],
            'description' => ['required', 'max:1000'],
            'short_description' => ['required', 'max:300'],
            'tags' => ['required', 'max:60'],
            'company_name' => ['required', 'max:100'],
            'company_registration' => ['required', 'max:100'],

            'city' => ['required', 'max:50'],
            'country' => ['required', 'max:50'],
            'post_code' => ['required', 'max:10'],
            'state' => ['required', 'max:20'],

        ]);

     


        $shop = Shop::updateOrCreate([

            'user_id' => auth()->user()->id,
        ], [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'tags' => $request->tags,
            'company_name' => $request->company_name,
            'company_registration' => $request->company_registration,
            'city' => $request->city,
            'state' => $request->state,
            'post_code' => $request->post_code,
            'country' => $request->country,

        ]);

        $slug = Str::slug($shop->name);
        if (shop::where('slug', $slug)->first()) {
            $slug = $slug . '-' . $shop->id;
        }
        $shop->update([
            'slug' =>  $slug,
        ]);



        return back()->with('success_msg', 'Success! Your shop has been updated/created');
    }
    public function shippingUrl(Request $request)
    {

        $order = Order::where('id', $request->order_id)->firstOrFail();
        $order->update(
            [
                'shipping_url' => $request->shipping_url,
                'shipping_method' => $request->shipping_method,
                'shipping_date' => $request->shipping_date,
                'status' => 2,
            ]
        );
        return back()->with('success_msg', 'Shop has been created!');
    }
    public function banner()
    {
        return view('auth.seller.banner');
    }
    public function bannerStore(Request $request)
    {
        $shop = auth()->user()->shop;
        $shop->createMetas($request->meta);

        return back()->with('success_msg', 'Banner has been created!');
    }
    public function shopSocialLinksStore(Request $request)
    {
        $request->validate([
            'meta.*.facebook' => 'nullable|string|max:100|url',
            'meta.*.linkedin' => 'nullable|string|max:100|url',
            'meta.*.instagram' => 'nullable|string|max:100|url',
            'meta.*.twitter' => 'nullable|string|max:100|url',
        ]);
        $shop = auth()->user()->shop;
        $shop->createMetas($request->meta);


        return back()->with('success_msg', 'Social Links has been Added!');
    }
    public function shopPolicy()
    {
        return view('auth.seller.shopPolicy');
    }
    public function shopPolicyStore(Request $request)
    {

        $shopPolicy = ShopPolicy::updateOrCreate([
            'shop_id' => auth()->user()->shop->id,
        ], [
            'delivery' => $request->delivery,
            'payment_option' => $request->payment_option,
            'return_exchange' => $request->return_exchange,
            'cancellation' => $request->cancellation,
        ]);

        return back()->with('success_msg', 'shop Policy has been created!');
    }
    public function offers()
    {
        $offers = Offer::where('shop_id', auth()->user()->shop->id)->latest()->get();
        return view('auth.seller.offers', compact('offers'));
    }
    public function offerAccept(Offer $offer)
    {

        $offer->update([
            'status' => 1,
            'is_offer' => 1,
        ]);
        $this->notification($offer->user_id, auth()->user()->shop->id, 'Offer Accpeted', '/user/dashboard/offers');
        Mail::to($offer->user->email)->send(new OfferEmail($offer));
        return back()->with('success_msg', 'Offer Accepted!');

        $offers = Offer::where('shop_id', auth()->user()->shop->id)->latest()->get();
        return view('auth.seller.offers');
    }
    public function offerDecline(Offer $offer)
    {

        $offer->update([
            'status' => 2,
        ]);
        $this->notification($offer->user_id, auth()->user()->shop->id, 'Offer Decline', '/user/dashboard/offers');
        return back()->with('success_msg', 'Offer Declined!');



        $offers = Offer::where('shop_id', auth()->user()->shop->id)->latest()->get();
        return view('auth.seller.offers');
    }

    public function orderSeen()
    {

        if (auth()->user()->role_id == 3) {
            $unseenOrders = Order::where('seen', false)->where('shop_id', auth()->user()->shop->id)->get();
            foreach ($unseenOrders as $unseenOrder) {
                $unseenOrder->update([
                    'seen' => true,
                ]);
            }
            return redirect()->route('vendor.ordersIndex');
        } else {
            $unseenOrders = Order::where('seen', false)->where('user_id', auth()->user()->id)->get();
            foreach ($unseenOrders as $unseenOrder) {
                $unseenOrder->update([
                    'seen' => true,
                ]);
            }
            return redirect()->route('user.ordersIndex');
        }
    }
    public function orderDeliver(Request $request, Order $order)
    {
        // Update the order status
        if ($order->status !== 3 && $order->shop_id == auth()->user()->shop->id) {
            $order->update([
                'status' => 4,
            ]);
        }
        $this->notification($order->user_id, auth()->user()->shop->id, 'Order Delivered', '/user/dashboard/orders/index');

        return back()->with('success_msg', 'Order has been delivered!');
    }
    public function orderCancel(Request $request, Order $order)
    {
        // Update the order status
        if ($order->status !== 3 && $order->shop_id == auth()->user()->shop->id) {
            if ($order->cancel_request == 1) {
                $order->update([
                    'cancel_request' => 2,
                ]);
            }
            $order->update([
                'status' => 3,
            ]);
        }
        $this->notification($order->user_id, auth()->user()->shop->id, 'Order Canceled', '/user/dashboard/orders/index');

        return back()->with('success_msg', 'Order has been delivered!');
    }
    public function orderApprove(Request $request, Order $order)
    {
        // Update the order status
        if ($order->status == 0 && $order->shop_id == auth()->user()->shop->id) {
            $order->update([
                'status' => 1,
                'cancel_request' => 0,
            ]);
        }
        $this->notification($order->user_id, auth()->user()->shop->id, 'Order Canceled', '/user/dashboard/orders/index');

        return back()->with('success_msg', 'Order has been delivered!');
    }

    public function logoCover(Request $request)
    {
        if ($request->file('logo')) {
            if (auth()->user()->shop) {
                $oldLogo = auth()->user()->shop->logo; // get the old logo file name
                if ($oldLogo) {
                    Storage::delete($oldLogo); // delete the old logo file
                }
            }
            Shop::updateOrCreate(['user_id' => auth()->user()->id], [
                'logo' => $request->logo->store("logo"),
            ]);
            return back()->with('success_msg', 'Logo upload successfully');
        }

        if ($request->file('banner')) {
            if (auth()->user()->shop) {
                $oldBanner = auth()->user()->shop->banner; // get the old banner file name
                if ($oldBanner) {
                    Storage::delete($oldBanner); // delete the old banner file
                }
            }
            Shop::updateOrCreate(['user_id' => auth()->user()->id], [
                'banner' => $request->banner->store("banners"),
            ]);
            return back()->with('success_msg', 'Banner upload successfully');
        }
    }
    public function settings()

    {

        return view('auth.seller.settings');
    }
    public function generalInfoUpdate(Request $request)
    {

        $data = $request->validate(
            [
                "tax_no" => "required",

            ]
        );
        auth()->user()->verification()->update([
            'tax_no' => $request->tax_no,

        ]);

        return back()->with('success_msg', 'General information updated successfully');
    }
    public function bankInfoUpdate(Request $request)
    {
        $data = $request->validate(
            [
                "paypal_email" => "required",

            ]
        );
        auth()->user()->verification()->update([
            'paypal_email' => $request->paypal_email,
        ]);

        return back()->with('success_msg', 'Bank information updated successfully');
    }
    public function shopAddressUpdate(Request $request)
    {
        $data = [
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address_1' => $request->address_1,
        ];

        Address::where('user_id', auth()->user()->id)->update($data);

        return back()->with('success_msg', 'Addresses updated successfully');
    }
    public function charges()
    {
        $charges = Auth()->user()->invoices();
        return view('auth.seller.charges', compact('charges'));
    }
    public function charge($charge)
    {
        $charge = auth()->user()->findInvoice($charge);
        return view('auth.seller.charge_invoice', compact('charge'));
    }
    public function shopMenuStore(Request $request)
    {
        $shop = auth()->user()->shop;
        $shop->createMetas($request->meta);
        return back()->with('success_msg', 'Shop Menu has been Added!');
    }

    protected function notification($user, $shop, $title, $url)
    {
        Notification::create([
            'url' => env('APP_URL') . $url,
            'title' => $title,
            'user_id' => $user,
        ]);
    }
    public function cancelSubscriptionNow()
    {
        try {
            $shop = auth()->user()->shop;
            auth()->user()->cancelSubscriptionNow();
            $shop->update([
                'status' => 0,
            ]);
            return back()->with('success_msg', 'your shop has been deactivated');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (Error $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function cancelSubscription()
    {

        try {
            auth()->user()->cancelSubscriptionNow();

            return back()->with('success_msg', 'Subscription has been Canceled');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (Error $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function resumeSubscription()
    {

        try {

            Stripe::setApiKey(Settings::setting('stripe_secret'));
            $product = StripeProduct::create([
                'name' => 'Basic Plan',
            ]);
            $price = Price::create([
                'product' => $product->id,
                'unit_amount' => 2495,
                'currency' => 'usd',
                'recurring' => [
                    'interval' => 'month',
                ],
                'nickname' => 'basic-monthly',
            ]);
            auth()->user()->newSubscription(
                'basic',
                $price->id
            )->create(auth()->user()->getCard()->id);

            return back()->with('success_msg', 'Subscription has been Resumed');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (Error $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function subscriptionStatus()
    {


        $getSubscription = auth()->user()->getSubscription();
        if ($getSubscription->stripe_status !== 'active' || $getSubscription->ends_at !== null) {
            $status = false;
        } else {
            $status = true;
        }
        return $status;
    }

    public function cardAdd(Request $request)
    {
        $request->validate([
            'payment_method' => 'required'
        ]);
        $customer = auth()->user()->createOrGetStripeCustomer();
        auth()->user()->addPaymentMethod($request->payment_method);
        return back()->with('success_msg', 'Subscription has been add Sucesss');
    }
    public function cards()
    {
        $status = $this->subscriptionStatus();
        $intent = auth()->user()->createSetupIntent();

        return view('auth.seller.cards', compact('intent', 'status'));
    }
    public function refundRequestAccept(Order $order)
    {
        if ($order->status == 5) {
            $order->update([
                'refund_request_accpet' => 1,
            ]);
            return back()->with('success_msg', 'Refund request accepted');
        } else {
            return redirect()->back()->withErrors('Please make sure user refund request send');
        }
    }

    public function personalInfoUpdate(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'avatar'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name   = $validated['first_name'];
        $user->l_name = $validated['last_name'];
        $user->email  = $validated['email'];

        if ($request->hasFile('avatar')) {
            // delete old avatar if exists
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }

            // store new avatar
            $user->avatar = $request->file('avatar')->store('avatars');
        }

        $user->save();

        return back()->with('success_msg', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'          => ['required', 'current_password'],
            'new_password'              => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success_msg', 'Password updated successfully!');
    }


    public function signatureStore(Request $request)
    {
        $request->validate([
            'signature' => 'required',
        ]);

        $signatureData = $request->signature;
        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = str_replace(' ', '+', $signatureData);
        $signatureImage = base64_decode($signatureData);
        $fileName = 'signature_' . time() . '.png';
        $filePath = storage_path('app/public/signatures/' . $fileName);
        file_put_contents($filePath, $signatureImage);

        Session::put('signature_path', 'signatures/' . $fileName);
        return back()->with('success_msg', 'Signature uploaded successfully!');
    }



    public function verificationPending()
    {
        if (auth()->user()->fourth_step_completed) {

            return view('pages.verification_pending');
        }else{
            return redirect()->route('vendor.create');
        }
    }
}
