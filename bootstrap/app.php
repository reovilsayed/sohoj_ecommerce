<?php

use App\Http\Middleware\ClearNotificationsMiddleware;
use App\Http\Middleware\EmailVerified;
use App\Http\Middleware\NeedPaymentMethod;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\SecondStepVerifications;
use App\Http\Middleware\Verified;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::

configure(basePath: dirname(__DIR__))
    
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
            'auth.basic' =>AuthenticateWithBasicAuth::class,
            'auth.session' =>AuthenticateSession::class,
            'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
            'signed' => \App\Http\Middleware\ValidateSignature::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            'role' => RoleMiddleware::class,
            'verifiedShop' => Verified::class,
            'verifiedEmail' => EmailVerified::class,
            'second' => SecondStepVerifications::class,
            'needPaymentMethod' => NeedPaymentMethod::class

        ])->validateCsrfTokens(except: [
            '/file/post'
        ]);
        
        // Append ClearNotificationsMiddleware to web group to prevent memory accumulation
        $middleware->web(append: [
            ClearNotificationsMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withProviders([
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\BroadcastServiceProvider::class,
        App\Providers\FilamentThemeServiceProvider::class,
    ])
    ->create();
