<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Verification;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function basicInfo()
    {
        return view('auth.seller.registration.basic-information');
    }
    public function verifyMassage()
    {
        return view('auth.seller.registration.email-verification');
    }
    public function termsAndConditions()
    {
        return view('auth.seller.registration.terms-and-condition');
    }

    public function termsAndConditionsStore(Request $request)
    {
        $request->validate([
            'signature' => 'required',
        ]);


        // Handle signature
        $signatureData = $request->signature;
        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = str_replace(' ', '+', $signatureData);
        $signatureImage = base64_decode($signatureData);
        $fileName = 'signature_' . time() . '.png';
        $filePath = storage_path('app/public/signatures/' . $fileName);
        file_put_contents($filePath, $signatureImage);



        $verification = Verification::updateOrCreate(['user_id' => auth()->id()], [
            'phone' => '',
            'address' => '',
            'signature' => 'signatures/' . $fileName,
        ]);

        return redirect()->route('vendor.registration.verification')->with('success', 'Verification created successfully');
    }


    public function vendorVerification()
    {
        return view('auth.seller.registration.vendor-information');
    }

    public function vendorVerificationStore(Request $request)
    {
        dd($request->all());
    }
}
