<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Class Namespace
    |--------------------------------------------------------------------------
    |
    | This value sets the root namespace for Livewire component classes in
    | your application. This value affects component auto-discovery and
    | any Livewire file helper commands, like `artisan make:livewire`.
    |
    | After changing this item, run: `php artisan livewire:discover`.
    |
    */

    'class_namespace' => 'App\\Http\\Livewire',

    /*
    |--------------------------------------------------------------------------
    | View Path
    |--------------------------------------------------------------------------
    |
    | This value sets the path for Livewire component views. This affects
    | file manipulation helper commands like `artisan make:livewire`.
    |
    */

    'view_path' => resource_path('views/livewire'),

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | The default layout view that will be used when rendering a component via
    | Route::get('/some-endpoint', SomeComponent::class);. In this case the
    | the view returned by SomeComponent will be wrapped in "layouts.app"
    |
    */

    'layout' => 'layouts.app',

    /*
    |--------------------------------------------------------------------------
    | Lazy Loading Placeholder
    |--------------------------------------------------------------------------
    |
    | Livewire allows you to lazy load components that would otherwise slow down
    | the initial page load. Every component that has a wire:key will be replaced
    | by this placeholder until it is fully loaded.
    |
    */

    'lazy_placeholder' => null,

    /*
    |--------------------------------------------------------------------------
    | Temporary File Uploads Endpoint Configuration
    |--------------------------------------------------------------------------
    |
    | Livewire handles file uploads by storing uploads in a temporary directory
    | before the file is validated and stored permanently. All file uploads
    | are directed to a global endpoint for temporary storage. The config
    | items below are used for customizing how Livewire handles uploads.
    |
    */

    'temporary_file_upload' => [
        'disk' => env('LIVEWIRE_TEMPORARY_FILE_UPLOAD_DISK', 'local'),
        'rules' => null, // ['file', 'mimes:png,jpg', 'max:12288'] (12MB)
        'directory' => null,
        'middleware' => null,
        'preview_mimes' => [
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpga', 'webp', 'wma',
        ],
        'max_upload_time' => 5, // Max time (in minutes) before an upload is invalidated.
    ],

    /*
    |--------------------------------------------------------------------------
    | Render On Redirect
    |--------------------------------------------------------------------------
    |
    | This value determines whether Livewire will render before it's redirected
    | or not. Setting it to "false" (default) will mean the render method is
    | skipped when redirecting. And "true" will mean the render method is
    | run before redirecting. Browsers bfcache can store a potentially
    | stale view if render is skipped on redirect.
    |
    */

    'render_on_redirect' => false,

    /*
    |--------------------------------------------------------------------------
    | Eloquent Model Binding
    |--------------------------------------------------------------------------
    |
    | Previous versions of Livewire allowed binding to Eloquent model properties
    | directly. This is no longer supported as it can lead to security issues.
    | You can enable this feature by setting this value to true.
    |
    */

    'legacy_model_binding' => false,

    /*
    |--------------------------------------------------------------------------
    | Auto-inject Frontend Assets
    |--------------------------------------------------------------------------
    |
    | By default, Livewire automatically injects its JavaScript and CSS into the
    | <head> and <body> of each page that includes Livewire components.
    | By setting this to false, you can disable this behavior.
    |
    */

    'inject_assets' => true,

    /*
    |--------------------------------------------------------------------------
    | Navigate (SPA mode)
    |--------------------------------------------------------------------------
    |
    | By adding `wire:navigate` to links in your Livewire application, Livewire
    | will prevent the default link handling and instead request those pages
    | via AJAX, creating an SPA (single-page application) effect.
    |
    */

    'navigate' => [
        'show_progress_bar' => true,
        'progress_bar_color' => '#2299dd',
    ],

    /*
    |--------------------------------------------------------------------------
    | HTML Morphing
    |--------------------------------------------------------------------------
    |
    | Livewire can "morph" one HTML string into another without having to
    | re-render the entire component. This feature is enabled by default
    | but can be disabled here.
    |
    */

    'morphing' => [
        'enabled' => true,
        'alpine' => [
            'enabled' => true,
            'persist' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | CSRF Protection
    |--------------------------------------------------------------------------
    |
    | Livewire automatically includes CSRF tokens in all requests to prevent
    | CSRF attacks. You can disable this feature if you're using a different
    | method for CSRF protection.
    |
    */

    'csrf' => true,

    /*
    |--------------------------------------------------------------------------
    | Session Configuration
    |--------------------------------------------------------------------------
    |
    | Livewire uses sessions to maintain component state. You can configure
    | how Livewire handles sessions here.
    |
    */

    'session' => [
        'driver' => env('SESSION_DRIVER', 'database'),
        'lifetime' => env('SESSION_LIFETIME', 120),
    ],
];
