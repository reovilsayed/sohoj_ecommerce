<?php

namespace App\Http\Controllers;

use App\Mail\TwoFactorCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class TwoFactorController extends Controller
{
    public function showChallenge(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('auth.twofactor');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string']
        ]);

        $user = Auth::user();
        if (!$user || !$user->two_factor_code || !$user->two_factor_expires_at) {
            return redirect()->route('login')->withErrors(['twofactor' => 'Session expired. Please login again.']);
        }

        if (now()->greaterThan($user->two_factor_expires_at)) {
            return back()->withErrors(['code' => 'The code has expired.']);
        }

        if (hash_equals((string)$user->two_factor_code, (string)$request->input('code')) === false) {
            return back()->withErrors(['code' => 'Invalid code.']);
        }

        $user->forceFill([
            'two_factor_code' => null,
            'two_factor_expires_at' => null,
        ])->save();

        $intended = session()->pull('intended_after_2fa');
        return redirect()->to($intended ?: url('/'));
    }

    public function resend(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $this->sendOtp($user);
        return back()->with('status', 'A new code has been sent to your email.');
    }

    public static function sendOtp($user): void
    {
        $code = (string) random_int(100000, 999999);
        $user->forceFill([
            'two_factor_code' => $code,
            'two_factor_expires_at' => now()->addMinutes(10),
        ])->save();

        Mail::to($user->email)->send(new TwoFactorCodeMail($code));
    }
}


