<?php

namespace Hosam\ProductCrud\Http\Repositories\Contract;

use App\Models\User;
use Hosam\ProductCrud\Models\Order;

interface ControlOrderInterface
{
    public function calculateTotalAmount(\Iterator $cartItems): float;

    public function moveCartItemsToOrder(Order $order, \Iterator $cartItems): void;

}
