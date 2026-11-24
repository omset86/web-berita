<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\SiteSetting;


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
        // Bagikan settings dan categories ke semua view
    View::share('settings', SiteSetting::get());
    View::share('categories', Category::where('is_active', true)->orderBy('sort_order')->get());
    }


}
