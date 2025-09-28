<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OptimizedFilamentMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Only apply optimizations to Filament panel requests
        if (!str_contains($request->path(), 'admin') && !str_contains($request->path(), 'vendor')) {
            return $next($request);
        }

        // Set memory limit for Filament requests
        $currentLimit = ini_get('memory_limit');
        if ($currentLimit !== '512M') {
            ini_set('memory_limit', '512M');
        }

        // Optimize session handling for Filament
        if ($request->hasSession()) {
            $session = $request->session();
            
            // Clean up old session data to prevent memory bloat
            $this->cleanupSessionData($session);
            
            // Limit Filament notifications to prevent accumulation
            $this->limitFilamentNotifications($session);
        }

        try {
            $response = $next($request);
            
            // Clean up after request
            $this->cleanupAfterRequest();
            
            return $response;
            
        } catch (\Throwable $e) {
            // Log memory usage on errors
            Log::error('Filament request error with memory info', [
                'error' => $e->getMessage(),
                'memory_usage' => $this->formatBytes(memory_get_usage(true)),
                'peak_memory' => $this->formatBytes(memory_get_peak_usage(true)),
                'url' => $request->fullUrl()
            ]);
            
            throw $e;
        }
    }

    private function cleanupSessionData($session)
    {
        // Remove old flash data that might be accumulating
        $flashData = $session->get('_flash', []);
        if (is_array($flashData) && count($flashData) > 10) {
            // Keep only the most recent flash data
            $session->put('_flash', array_slice($flashData, -5));
        }
    }

    private function limitFilamentNotifications($session)
    {
        $notifications = $session->get('filament.notifications', []);
        
        if (is_array($notifications) && count($notifications) > 5) {
            // Keep only the 5 most recent notifications
            $session->put('filament.notifications', array_slice($notifications, -5));
            
            Log::info('Limited Filament notifications to prevent memory issues', [
                'original_count' => count($notifications),
                'kept_count' => 5
            ]);
        }
    }

    private function cleanupAfterRequest()
    {
        // Force garbage collection if memory usage is high
        $memoryUsage = memory_get_usage(true);
        if ($memoryUsage > 200 * 1024 * 1024) { // 200MB
            gc_collect_cycles();
            
            Log::info('Forced garbage collection due to high memory usage', [
                'memory_before_gc' => $this->formatBytes($memoryUsage),
                'memory_after_gc' => $this->formatBytes(memory_get_usage(true))
            ]);
        }
    }

    private function formatBytes($size, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        
        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        
        return round($size, $precision) . ' ' . $units[$i];
    }
}
