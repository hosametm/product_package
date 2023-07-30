<?php

namespace Hosam\ProductCrud\Http\Controllers;

use App\Http\Controllers\Controller;

use Hosam\ProductCrud\Http\Repositories\Contract\CartInterface;
use Hosam\ProductCrud\Http\Repositories\Eloquent\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    public function addToCart(Request $request)
    {
        try {

            if (!Cache::get('temp_id')) {
                $guestId = uniqid('guest-', true);
                Cache::put('temp_id', $guestId, 3600);
            }
            $productId = $request->productId;
            $quantity = $request->quantity ?? 1;
            $this->cart->addToCart($productId, $quantity, Cache::get('temp_id'));
            return back();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function viewCart()
    {
        try {
            Cache::get('temp_id') ?: Cache::put('temp_id', uniqid('guest-', true), 3600);
            $carts = $this->cart->getCartItems();
            return view('product_crud::front.products.cart', compact('carts'));
        } catch (\Throwable $throwable) {
            dd($throwable->getMessage());
        }
    }

    public function clearCart()
    {
        try {
            $this->cart->clearCart() ? $message = "success" : $message = 'failed';
            return back()->with(['message' => $message]);
        } catch (\Throwable $throwable) {
            dd($throwable->getMessage());
        }
    }

}
