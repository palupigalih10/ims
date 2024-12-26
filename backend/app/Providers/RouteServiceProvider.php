<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Defined API v1 route path.
     * 
     * @var string 
     */
    const APIV1_PATH =  'routes/api/v1';

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            // Api V1 routes
            Route::prefix('v1')->group(function () {
                // Admin routes
                Route::namespace('App\\Http\\Controllers\\Admin')
                    ->group(base_path(self::APIV1_PATH . '/admin.php'));
            });
        });
    }
}
