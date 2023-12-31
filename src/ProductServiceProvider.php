<?php

namespace Hosam\ProductCrud;

use Hosam\ProductCrud\Http\Listeners\OnLogin;
use Hosam\ProductCrud\Http\Repositories\Contract\CartInterface;
use Hosam\ProductCrud\Http\Repositories\Contract\CategoryInterface;
use Hosam\ProductCrud\Http\Repositories\Contract\OrderInterface;
use Hosam\ProductCrud\Http\Repositories\Contract\ProductInterface;
use Hosam\ProductCrud\Http\Repositories\Eloquent\CartRepository;
use Hosam\ProductCrud\Http\Repositories\Eloquent\CategoryRepository;
use Hosam\ProductCrud\Http\Repositories\Eloquent\OrderRepository;
use Hosam\ProductCrud\Http\Repositories\Eloquent\ProductRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
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
        Route::middleware('web')
            ->group(__DIR__ . '/routes/web.php');
    }


    public function register(): void
    {
        Paginator::useBootstrap();
        Event::listen(Login::class, OnLogin::class);
        app()->bind(CartInterface::class, CartRepository::class);
        app()->bind(CategoryInterface::class, CategoryRepository::class);
        app()->bind(OrderInterface::class, OrderRepository::class);
        app()->bind(ProductInterface::class, ProductRepository::class);
    }
}
