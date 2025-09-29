<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Memory Management
    |--------------------------------------------------------------------------
    |
    | Configuration for memory management and performance optimization
    |
    */

    'memory' => [
        'limit' => env('PHP_MEMORY_LIMIT', '512M'),
        'gc_threshold' => env('PHP_GC_THRESHOLD', 200), // MB
        'force_gc_on_high_usage' => env('PHP_FORCE_GC', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Session Optimization
    |--------------------------------------------------------------------------
    |
    | Settings to optimize session handling and prevent memory bloat
    |
    */

    'session' => [
        'max_notifications' => env('SESSION_MAX_NOTIFICATIONS', 5),
        'cleanup_flash_data' => env('SESSION_CLEANUP_FLASH', true),
        'max_flash_items' => env('SESSION_MAX_FLASH_ITEMS', 10),
    ],

    /*
    |--------------------------------------------------------------------------
    | Filament Optimization
    |--------------------------------------------------------------------------
    |
    | Settings specific to Filament panel optimization
    |
    */

    'filament' => [
        'enable_memory_monitoring' => env('FILAMENT_MEMORY_MONITORING', true),
        'max_widgets_per_page' => env('FILAMENT_MAX_WIDGETS', 10),
        'lazy_load_resources' => env('FILAMENT_LAZY_LOAD', true),
        'disable_heavy_queries' => env('FILAMENT_DISABLE_HEAVY_QUERIES', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Query Optimization
    |--------------------------------------------------------------------------
    |
    | Settings for database query optimization
    |
    */

    'queries' => [
        'max_queries_per_request' => env('MAX_QUERIES_PER_REQUEST', 100),
        'log_slow_queries' => env('LOG_SLOW_QUERIES', true),
        'slow_query_threshold' => env('SLOW_QUERY_THRESHOLD', 1000), // milliseconds
        'enable_query_caching' => env('ENABLE_QUERY_CACHING', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Optimization
    |--------------------------------------------------------------------------
    |
    | Settings for cache optimization
    |
    */

    'cache' => [
        'default_ttl' => env('CACHE_DEFAULT_TTL', 3600), // 1 hour
        'max_cache_size' => env('CACHE_MAX_SIZE', '100MB'),
        'enable_compression' => env('CACHE_COMPRESSION', true),
    ],
];
