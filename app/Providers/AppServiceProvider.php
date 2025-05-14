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
        Cookie::defaults(function() {
        return Cookie::make(
            name: 'laravel_session',
            domain: '.railway.app',  // Leading dot for subdomains
            secure: true,
            httpOnly: true,
            sameSite: 'none',  // Required for Railway's proxy
            partitioned: true  // For Chrome's new cookie rules
        );
        });

                // Force HTTPS URLs in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Route::middleware('api')
            ->prefix('api') // Optional: Adds `/api` prefix
            ->group(base_path('routes/api.php'));
    }
}
