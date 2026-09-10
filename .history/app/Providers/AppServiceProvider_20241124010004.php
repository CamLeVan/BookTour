<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Services\BookingService;
use App\Services\MockPaymentService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(BookingService::class);
        $this->app->singleton(MockPaymentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('spadmin.layouts.app', 'spadmin-layout');
        Blade::component('admin.layouts.app', 'admin-layout');
        Blade::component(
            'frontend.home.testimonials',
            \App\View\Components\Frontend\Home\Testimonials::class
        );
    }
}
