<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Services\MigratorService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Konfigurasi Migrasi
        // Uncomment kode berikut jika menggunakan mysql < 5.7.7 atau mariadb < 10.2.2
        //Schema::defaultStringLength(191);
        
        $this->app->bind('App\Services\MigrationService', function($app) {
            return new MigratorService;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
