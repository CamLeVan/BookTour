<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
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
        Blade::component('spadmin.layouts.app', 'spadmin-layout');
        Blade::component('frontend.home.testimonials', \App\View\Components\Frontend\Home\Testimonials::class);
    }
}
