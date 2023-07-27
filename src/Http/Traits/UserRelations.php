<?php

namespace Hosam\ProductCrud\Http\Traits;

use Hosam\ProductCrud\Models\Cart;
use Hosam\ProductCrud\Models\Order;

trait UserRelations
{
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
