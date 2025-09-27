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
            
            // Note: Removed $request->session()->forget('_flash') as it was preventing
            // Laravel flash messages from working properly. The _flash key is used
            // by Laravel to manage flash data and should not be manually cleared.
            
            // Force garbage collection periodically
            if (rand(1, 100) === 1) {
                $request->session()->regenerate();
            }
        }
        
        return $response;
    }
}
