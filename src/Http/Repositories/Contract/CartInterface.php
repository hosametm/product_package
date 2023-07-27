<?php

namespace Hosam\ProductCrud\Http\Repositories\Contract;

interface CartInterface
{
    public function addToCart(int $productId, int $quantity): void;

    public function getCartItems();

    public function clearCart();
}
