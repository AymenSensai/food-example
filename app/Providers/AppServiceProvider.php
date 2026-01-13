<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Use View Composer to load settings only when views are rendered
        // This prevents DB connection errors during console commands (like config:cache)
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            try {
                // Check if we already have the settings to avoid repetitive queries if cached (optional optimization)
                // For now, simple try-catch block is sufficient to prevent crashes if DB is down setup is incomplete
                static $settings;
                
                if (!$settings) {
                    $settings = \App\Models\CompanySetting::first();
                }
                
                $view->with('companySettings', $settings);
            } catch (\Exception $e) {
                // If DB connection fails (e.g. during migration or initial setup), just share null
                // This allows artisan commands to run even if DB is broken
                $view->with('companySettings', null);
            }
        });
    }
}
