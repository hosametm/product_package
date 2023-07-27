<?php

namespace Hosam\ProductCrud\Http\Repositories\Contract;

use App\Models\Order;
use App\Models\User;

interface ControlOrderInterface
{
    public function calculateTotalAmount(\Iterator $cartItems): float;

    public function moveCartItemsToOrder(Order $order, \Iterator $cartItems): void;

    public function clearCart(User $user): void;
}
