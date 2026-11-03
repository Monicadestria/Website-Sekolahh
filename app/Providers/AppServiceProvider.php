<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        
        // Set timezone to Indonesia
        Paginator::useBootstrapFive();
        date_default_timezone_set('Asia/Jakarta');

        $this->loadHelpers();
    }

    protected function loadHelpers()
    {
        require_once app_path('TimeHelpers.php');
    }
}
