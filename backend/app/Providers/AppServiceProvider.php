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
                database_path('migrations/identity'),
                database_path('migrations/tenant_catalog'),
                database_path('migrations/booking'),
                database_path('migrations/commerce'),
                database_path('migrations/engagement'),
                database_path('migrations/audit'),
            ]);
        }
    }
}
