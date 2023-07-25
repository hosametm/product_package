<?php
namespace Hosam\ProductCrud;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'product_crud');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }


    public function register()
    {
        Paginator::useBootstrap();
    }
}
