<?php

namespace Hosam\ProductCrud\Http\Repositories\Contract;

interface CartInterface
{
    public function addToCart(int $productId, int $quantity,$guestId): void;

    public function getCartItems();

    public function clearCart();
}
