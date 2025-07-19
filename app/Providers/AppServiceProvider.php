<?php

namespace App\Providers;
use App\Facade\Sohoj;
use App\Setting\Settings;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $this->app->bind('sohoj', function () {
            return new Sohoj();
        });
         $this->app->bind('settings', function () {
            return new Settings();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
