<?php

namespace Hosam\ProductCrud\Http\Controllers;

use App\Http\Controllers\Controller;
use Hosam\ProductCrud\Http\Repositories\Contract\CartInterface;
use Hosam\ProductCrud\Http\Repositories\Contract\OrderInterface;


class OrderController extends Controller
{
    public function __construct(protected OrderInterface $order, protected CartInterface $cart )
    {
    }

    public function find(int $id)
    {
        $order = $this->order->find($id);
        return view('auth.confirm-password', compact('order'));
    }

    public function create()
    {
        $total_amount = $this->order->calculateTotalAmount(auth()->user()?->carts);
        $order = $this->order->create($total_amount);
        $this->cart->clearCart();
        return $order ? back() : 0;
    }

}
