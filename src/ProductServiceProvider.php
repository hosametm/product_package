<?php

namespace Hosam\ProductCrud;

use Hosam\ProductCrud\Http\Listeners\OnLogin;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;

class ProductServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'product_crud');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->publishes([
            __DIR__ . '/views/products/partials' => resource_path('views/vendor/product_crud/products/partials'),
            __DIR__ . '/views/categories/partials' => resource_path('views/vendor/product_crud/categories/partials')
        ]);
    }


    public function register(): void
    {
        Paginator::useBootstrap();
        Event::listen(Login::class, OnLogin::class);
    }
}
