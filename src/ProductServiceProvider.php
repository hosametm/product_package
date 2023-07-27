<?php

namespace Hosam\ProductCrud;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'product_crud');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->publishes([
            __DIR__ . '/views/products/partials' => resource_path('views/vendor/product_crud/products/partials')
        ]);
    }


    public function register(): void
    {
        Paginator::useBootstrap();
    }
}
