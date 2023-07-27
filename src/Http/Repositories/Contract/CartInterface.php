<?php

namespace Hosam\ProductCrud\Http\Repositories\Contract;

use App\Models\User;
use Illuminate\Http\Request;


interface CartInterface
{
    public function addToCart(int $productId, int $quantity): void;

    public function getCartItems();

    public function clearCart();
}
