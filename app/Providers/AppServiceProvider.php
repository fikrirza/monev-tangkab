<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ActivityService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Untuk sementara, register ActivityService pada AppServiceProvider
        $this->app->singleton('Services\Activity', function() {
            return new ActivityService();
        });
    }
}
