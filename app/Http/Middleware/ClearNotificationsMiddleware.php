<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClearNotificationsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Clear notifications after each request to prevent memory accumulation
        if ($request->hasSession()) {
            // Clear Filament notifications
            $request->session()->forget('filament.notifications');
            $request->session()->forget('notifications');
            
            // Clear any other potential memory-heavy session data
            $request->session()->forget('_flash');
            
            // Force garbage collection periodically
            if (rand(1, 100) === 1) {
                $request->session()->regenerate();
            }
        }
        
        return $response;
    }
}
