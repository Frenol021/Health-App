<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Cookie;
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

                // Force HTTPS URLs in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Route::middleware('api')
            ->prefix('api') // Optional: Adds `/api` prefix
            ->group(base_path('routes/api.php'));

            Cookie::defaults(function() {
        return Cookie::make(
            name: 'laravel_session',
            domain: '.railway.app', // Leading dot for subdomains
            secure: true,           // HTTPS-only
            httpOnly: true,         // Prevent JS access
            sameSite: 'none',        // Required for Railway
            partitioned: true        // Chrome 2024+ requirement
        );
    });
    }
}
