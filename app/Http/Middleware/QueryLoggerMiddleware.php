<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class QueryLoggerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Start query logging
        $startTime = microtime(true);
        $startMemory = memory_get_usage(true);
        
        // Log the request
        Log::channel('query')->info('=== REQUEST START ===', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'user_id' => Auth::id(),
            'start_memory' => $this->formatBytes($startMemory),
            'timestamp' => now()->toISOString()
        ]);

        $queryCount = 0;
        $queryLog = [];

        // Enable query logging
        DB::listen(function ($query) use (&$queryCount, &$queryLog) {
            $queryCount++;
            $currentMemory = memory_get_usage(true);
            
            $queryLog[] = [
                'query_number' => $queryCount,
                'sql' => $query->sql,
                'bindings' => $query->bindings,
                'time' => $query->time,
                'memory_after_query' => $this->formatBytes($currentMemory),
                'connection' => $query->connectionName
            ];

            // Log memory-heavy queries immediately
            if ($currentMemory > 100 * 1024 * 1024) { // 100MB
                Log::channel('query')->warning('HIGH MEMORY QUERY DETECTED', [
                    'query_number' => $queryCount,
                    'sql' => $query->sql,
                    'bindings' => $query->bindings,
                    'time' => $query->time . 'ms',
                    'memory_usage' => $this->formatBytes($currentMemory)
                ]);
            }

            // Log excessive query counts
            if ($queryCount > 50 && $queryCount % 10 === 0) {
                Log::channel('query')->warning('HIGH QUERY COUNT', [
                    'query_count' => $queryCount,
                    'current_memory' => $this->formatBytes($currentMemory)
                ]);
            }
        });

        try {
            $response = $next($request);
        } catch (\Throwable $e) {
            $errorMemory = memory_get_usage(true);
            
            Log::channel('query')->error('REQUEST FAILED WITH ERROR', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'memory_at_error' => $this->formatBytes($errorMemory),
                'total_queries' => $queryCount,
                'url' => $request->fullUrl()
            ]);

            // Log all queries that led to the error
            if (!empty($queryLog)) {
                Log::channel('query')->error('QUERIES BEFORE ERROR', [
                    'queries' => array_slice($queryLog, -10) // Last 10 queries
                ]);
            }

            throw $e;
        }

        $endTime = microtime(true);
        $endMemory = memory_get_usage(true);
        $peakMemory = memory_get_peak_usage(true);

        // Log request completion
        Log::channel('query')->info('=== REQUEST END ===', [
            'url' => $request->fullUrl(),
            'total_time' => round(($endTime - $startTime) * 1000, 2) . 'ms',
            'start_memory' => $this->formatBytes($startMemory),
            'end_memory' => $this->formatBytes($endMemory),
            'peak_memory' => $this->formatBytes($peakMemory),
            'memory_increase' => $this->formatBytes($endMemory - $startMemory),
            'total_queries' => $queryCount,
            'status' => $response->getStatusCode()
        ]);

        // Log memory-heavy requests
        if ($peakMemory > 500 * 1024 * 1024) { // 500MB
            Log::channel('query')->critical('MEMORY CRITICAL REQUEST', [
                'url' => $request->fullUrl(),
                'peak_memory' => $this->formatBytes($peakMemory),
                'total_queries' => $queryCount,
                'top_queries' => array_slice($queryLog, -5) // Last 5 queries
            ]);
        }

        return $response;
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
