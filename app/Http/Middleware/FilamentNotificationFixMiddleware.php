<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class FilamentNotificationFixMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Clean up corrupted notifications before processing
        $this->cleanupCorruptedNotifications();
        
        $response = $next($request);
        
        // Emergency cleanup if notifications are still accumulating
        $this->emergencyCleanupIfNeeded();
        
        return $response;
    }

    private function cleanupCorruptedNotifications(): void
    {
        if (!session()->has('filament.notifications')) {
            return;
        }

        $notifications = session()->get('filament.notifications', []);
        
        if (!is_array($notifications)) {
            session()->forget('filament.notifications');
            Log::warning('Fixed corrupted filament notifications session data');
            return;
        }

        $validNotifications = [];
        $removedCount = 0;

        foreach ($notifications as $notification) {
            try {
                // Test if notification can be properly deserialized
                if (is_array($notification) && 
                    isset($notification['id']) && 
                    isset($notification['title'])) {
                    $validNotifications[] = $notification;
                } else {
                    $removedCount++;
                }
            } catch (\Exception $e) {
                $removedCount++;
                Log::warning('Removed corrupted notification', [
                    'error' => $e->getMessage()
                ]);
            }
        }

        // Limit to maximum 3 notifications to prevent accumulation
        if (count($validNotifications) > 3) {
            $validNotifications = array_slice($validNotifications, -3);
            $removedCount += count($notifications) - 3;
        }

        if ($removedCount > 0) {
            session()->put('filament.notifications', $validNotifications);
            Log::info('Cleaned up filament notifications', [
                'removed_count' => $removedCount,
                'kept_count' => count($validNotifications)
            ]);
        }
    }

    private function emergencyCleanupIfNeeded(): void
    {
        // Check memory usage
        $memoryUsage = memory_get_usage(true);
        $memoryLimit = $this->convertToBytes(ini_get('memory_limit'));
        
        // If we're using more than 70% of memory limit, do emergency cleanup
        if ($memoryUsage > ($memoryLimit * 0.7)) {
            if (session()->has('filament.notifications')) {
                $notifications = session()->get('filament.notifications', []);
                if (is_array($notifications) && count($notifications) > 1) {
                    // Keep only the most recent notification
                    $recentNotification = array_slice($notifications, -1);
                    session()->put('filament.notifications', $recentNotification);
                    
                    Log::warning('Emergency cleanup triggered - high memory usage', [
                        'memory_usage' => $this->formatBytes($memoryUsage),
                        'memory_limit' => ini_get('memory_limit'),
                        'notifications_removed' => count($notifications) - 1
                    ]);
                }
            }
        }
    }

    private function convertToBytes($value): int
    {
        $value = trim($value);
        $last = strtolower($value[strlen($value)-1]);
        $value = (int)$value;

        switch($last) {
            case 'g': $value *= 1024;
            case 'm': $value *= 1024;
            case 'k': $value *= 1024;
        }

        return $value;
    }

    private function formatBytes($bytes, $precision = 2): string
    {
        $units = array('B', 'KB', 'MB', 'GB');
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
