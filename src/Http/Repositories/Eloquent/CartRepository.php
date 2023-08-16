<?php

namespace Hosam\ProductCrud\Http\Repositories\Eloquent;

use Hosam\ProductCrud\Http\Repositories\Contract\CartInterface;
use Hosam\ProductCrud\Models\Cart;
use Illuminate\Support\Facades\Cache;


class CartRepository implements CartInterface
{

    public function addToCart(int $productStockId, int $quantity, $guestId): void
    {
        // TODO: Implement addToCart() method.
        if ($item = $this->cartItem($productStockId, $guestId)) {
            $item->update(['quantity' => $item->quantity + $quantity]);
        } else {
            $this->saveCartItem($productStockId, $quantity, $guestId);
        }
    }

    public function getCartItems()
    {
        // TODO: Implement getCartItems() method.
        return auth()->check()
            ? auth()->user()?->carts()->with('product')->get()
            : Cart::whereGuestId(request()?->cookie('temp_id'))->whereNotNull('guest_id')->with('product')->get();
    }

    public function clearCart()
    {
        // TODO: Implement clearCart() method.
        return auth()->check()
            ? auth()->user()?->carts()->delete()
            : Cart::whereGuestId(request()?->cookie('temp_id'))->delete();
    }

    private function cartItem($productStockId, $guestId)
    {
        return auth()->check()
            ? auth()->user()?->carts()->whereProductStockId($productStockId)->first()
            : Cart::whereProductStockId($productStockId)->whereGuestId($guestId)->first();
    }

    private function saveCartItem($productStockId, $quantity, $guestId)
    {
        try {
            Cart::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'product_stock_id' => $productStockId,
                'quantity' => $quantity,
                'guest_id' => auth()->check() ? null : $guestId
            ]);
        } catch (\Throwable $throwable) {
            dd($throwable->getMessage());
        }
    }
}
