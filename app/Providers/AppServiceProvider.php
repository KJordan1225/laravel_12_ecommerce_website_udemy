<?php

namespace App\Providers;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrapFive();
        //share data with the navbar
        View::composer('layouts.partials.navbar', function($view) {
            $view->with([
                'categories' => Category::has('products')->get(),
                'brands' => Brand::has('products')->get(),
                'colors' => Color::has('products')->get(),
                'sizes' => Size::has('products')->get(),
            ]);
        });
    }
}
