<?php
/**
 * Simple monitoring script to check if the fixes are working
 * Run this script to monitor your Filament panel performance
 */

echo "=== Filament Panel Performance Monitor ===\n\n";

// Check memory usage
$memoryUsage = memory_get_usage(true);
$peakMemory = memory_get_peak_usage(true);
$memoryLimit = ini_get('memory_limit');

echo "Memory Status:\n";
echo "- Current Usage: " . formatBytes($memoryUsage) . "\n";
echo "- Peak Usage: " . formatBytes($peakMemory) . "\n";
echo "- Memory Limit: " . $memoryLimit . "\n";
echo "- Usage Percentage: " . round(($memoryUsage / convertToBytes($memoryLimit)) * 100, 2) . "%\n\n";

// Check session configuration
echo "Session Configuration:\n";
echo "- Driver: " . (getenv('SESSION_DRIVER') ?: 'database') . "\n";
echo "- Lifetime: " . (getenv('SESSION_LIFETIME') ?: '120') . " minutes\n";
echo "- Encryption: " . (getenv('SESSION_ENCRYPT') ?: 'false') . "\n\n";

// Check if Livewire config exists
if (file_exists(__DIR__ . '/config/livewire.php')) {
    echo "✅ Livewire configuration file exists\n";
} else {
    echo "❌ Livewire configuration file missing\n";
}

// Check if optimized middleware exists
if (file_exists(__DIR__ . '/app/Http/Middleware/OptimizedFilamentMiddleware.php')) {
    echo "✅ Optimized Filament middleware exists\n";
} else {
    echo "❌ Optimized Filament middleware missing\n";
}

// Check if cleanup command exists
if (file_exists(__DIR__ . '/app/Console/Commands/CleanupMemoryIssues.php')) {
    echo "✅ Memory cleanup command exists\n";
} else {
    echo "❌ Memory cleanup command missing\n";
}

echo "\n=== Recommendations ===\n";
echo "1. Run 'php artisan cleanup:memory-issues' to clean up old sessions and cache\n";
echo "2. Monitor your logs for CSRF and memory issues\n";
echo "3. Consider setting up a cron job to run cleanup regularly\n";
echo "4. If issues persist, check your server's PHP memory limit\n\n";

function formatBytes($size, $precision = 2)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    
    for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
        $size /= 1024;
    }
    
    return round($size, $precision) . ' ' . $units[$i];
}

function convertToBytes($value)
{
    $value = trim($value);
    $last = strtolower($value[strlen($value)-1]);
    $value = (int) $value;
    
    switch($last) {
        case 'g':
            $value *= 1024;
        case 'm':
            $value *= 1024;
        case 'k':
            $value *= 1024;
    }
    
    return $value;
}
