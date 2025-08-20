<?php

namespace App\Http\Controllers;

use App\Mail\VendorVerificationSuccess;
use App\Mail\VerifyEmail;
use App\Models\Address;
use App\Models\BankAccount;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\User;
use App\Models\Product as ProductModel;
use App\Models\Shop;
use App\Models\Verification;
use App\Setting\Settings;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;
use Stripe\Price;
use Stripe\Product;
use Stripe\Stripe;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    public function againVerifyEmail()
    {
        $verify_token = Str::random(20);
        $user = auth()->user();
        Mail::to($user->email)->send(new VerifyEmail($user, $verify_token));
        return back()->with('success_msg', 'Resend email send successfully send');
    }

    public function verifyEmail()
    {
        $user = Auth()->user();
        $user->update([
            'remember_token' => request('token'),
            'email_verified_at' => now(),
        ]);
        return redirect()->route('vendor.second.step');
    }
    public function verifyMassage()
    {
        return view('verify_massage');
    }
    public function vendorSecondStep()
    {
        $user = auth()->user();
        return view('auth.seller.second_step', [
            'intent' => $user->createSetupIntent()
        ]);
    }
    public function vendorSecondStepStore(Request $request)
    {
        // Validate basic fields
        $validationRules = [
            "phone" => "required",
            "dob"  => "required",
            "tax_no" =>  "nullable",
            "address" => "required",
            "country" => "required",
            "state" => "required",
            "city" => "required",
            "post_code" => "required",
            "govt_id_back" => "required|image|mimes:jpeg,png",
            "govt_id_front" => "required|image|mimes:jpeg,png",
            // "payment_method_type" => "required|in:bank_account,paypal",
        ];
        // dd($request->payment_method_type);
        // Add validation rules based on payment method type
        if ($request->payment_method_type == 'bank') {
            $validationRules = array_merge($validationRules, [
                'bank_name' => 'required|string|max:255',
                'account_holder' => 'required|string|max:255',
                'account_number' => 'required|string|max:50',
                'routing_number' => 'required|string|max:50',
                'account_type' => 'required|in:Checking,Savings',
                'currency' => 'required|string|max:3',
                'bank_address' => 'nullable|string|max:500',
                'swift_code' => 'nullable|string|max:11',
                'iban' => 'nullable|string|max:34',
            ]);
        } elseif ($request->payment_method_type == 'paypal') {
            $validationRules = array_merge($validationRules, [
                'paypal_email' => 'required|email|max:255',
                'paypal_email_confirmation' => 'required|same:paypal_email',
            ]);
        }

        $data = $request->validate($validationRules);

        // Handle signature
        $signatureData = $request->signature;
        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = str_replace(' ', '+', $signatureData);
        $signatureImage = base64_decode($signatureData);
        $fileName = 'signature_' . time() . '.png';
        $filePath = storage_path('app/public/signatures/' . $fileName);
        file_put_contents($filePath, $signatureImage);

        // Stripe setup (if using Stripe)
        if ($request->has('payment_method')) {
            auth()->user()->createOrGetStripeCustomer();
            auth()->user()->addPaymentMethod($data['payment_method']);
        }

        // Create Stripe subscription if needed
        Stripe::setApiKey(\App\Setting\Settings::setting('stripe_secret'));
        $product = Product::create([
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
        $user = User::find(auth()->id());

        $sub = $user->newSubscription('basic', $price->id);
        if (setting('site.free_trial') == "on") {
            $sub->trialUntil(Carbon::now()->addDays(30));
        }

        // $sub->create($data['payment_method']);
        // Store bank account data if bank account method is selected
        if ($request->payment_method_type == 'bank') {
            BankAccount::create([
                'user_id' => auth()->id(),
                'bank_name' => $request->bank_name,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'routing_number' => $request->routing_number,
                'account_type' => $request->account_type,
                'currency' => $request->currency,
                'bank_address' => $request->bank_address,
                'swift_code' => $request->swift_code,
                'iban' => $request->iban,
                'is_default' => true, // First bank account is default
                'status' => 'active',
            ]);
        }

        // Create verification record
        $verificationData = [
            'user_id' => auth()->id(),
            'phone' => $request->phone,
            'govt_id_front' => $request->file('govt_id_front') ? $request->file('govt_id_front')->storeAs('verifications', $request->file('govt_id_front')->hashName(), 'public') : null,
            'govt_id_back' => $request->file('govt_id_back') ? $request->file('govt_id_back')->storeAs('verifications', $request->file('govt_id_back')->hashName(), 'public') : null,
            'address' => $request->address,
            'ismonthly_charge' => $request->ismonthly_charge,
            'signature' => 'signatures/' . $fileName,
        ];

        // Add payment method specific data to verification
        if ($request->payment_method_type == 'paypal') {
            $verificationData['paypal_email'] = $request->paypal_email;
        }

        $verification = Verification::create($verificationData);

        // Create address
        Address::create([
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'post_code' => $request->post_code,
            'user_id' => auth()->id(),
            'address_1' => $request->address,
            'phone' => $request->phone,
        ]);

        // Send notification email
        Mail::to(Settings::setting('admin_email'))->send(new VendorVerificationSuccess($user, $verification));
        
        return redirect('/vendor')->with('success_msg', 'Thanks for your information. Your ' . ($request->payment_method_type === 'bank_account' ? 'bank account' : 'PayPal') . ' details have been saved successfully.');
    }
    public function offer(ProductModel $product, Request $request)
    {
        if ($product->sale_price) {
            $price = $product->sale_price;
        } else {
            $price = $product->price;
        }
        if ($request->price < $price) {
            Offer::create([
                'price' => $request->price,
                'qty' => $request->qty,
                'product_id' => $product->id,
                'shop_id' => $product->shop_id,
                'user_id' => Auth()->id(),
            ]);
            $this->notification(Auth()->id(), $product->shop_id);
            return redirect()->back()->with('success_msg', 'Offer create successfull ');
        } else {
            return back()->withErrors('Sorry! your price greater then product price');
        }
    }

    protected function notification($user, $shop)
    {
        Notification::create([
            'url' => env('APP_URL') . '/vendor/dasboard/offers',
            'title' => 'Offer Created',

            'shop_id' => $shop,
        ]);
    }

    public function shopActive(Shop $shop)
    {
        if ($shop->status == 0) {
            $shop->update([
                'status' => true,
            ]);
        } else {
            $shop->update([
                'status' => false,
            ]);
        }
        return back()->with([
            'message'    => "Shop Action create",
            'alert-type' => 'success',
        ]);
    }

    public function freeforlife(Shop $shop)
    {
        try {
            if ($shop->user->ffl == 0) {
                $shop->user->cancelSubscriptionNow();
                $shop->user->update([
                    'ffl' => true,
                ]);
            } else {
                $shop->user->update([
                    'ffl' => false,
                ]);
            }
            return back()->with([
                'message'    => "Shop is now free",
                'alert-type' => 'success',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'message'    => $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }
}
