<?php

namespace App\Providers;

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
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom([
                database_path('migrations/01_identity'),
                database_path('migrations/02_tenant_catalog'),
                database_path('migrations/03_booking'),
                database_path('migrations/04_commerce'),
                database_path('migrations/05_engagement'),
                database_path('migrations/06_audit'),
            ]);
        }
    }
}
