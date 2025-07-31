<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClearNotificationsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Clear Filament notifications to prevent memory accumulation
        if (session()->has('filament.notifications')) {
            session()->forget('filament.notifications');
        }

        // Clear flash data that might accumulate
        if (session()->has('_flash')) {
            session()->forget('_flash');
        }

        // Regenerate session ID periodically to prevent session bloat
        static $requestCount = 0;
        $requestCount++;
        if ($requestCount % 10 === 0) {
            session()->regenerate();
        }

        return $response;
    }
    
}
