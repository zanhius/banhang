<?php

namespace App\Providers;

use App\View\Components\CustomerAppLayout;
use App\View\Components\CustomerGuestLayout;
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
        //
        $this->loadViewComponentsAs('customer', [
            CustomerAppLayout::class,
            CustomerGuestLayout::class,
        ]);
    }
}
