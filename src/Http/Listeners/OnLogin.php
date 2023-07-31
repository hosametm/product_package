<?php

namespace Hosam\ProductCrud\Http\Listeners;


use Hosam\ProductCrud\Models\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class OnLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $temp_id = request()?->cookie('temp_id');
        $user = $event->user;
        $cart = Cart::whereGuestId($temp_id)->get();
        $cart->each(function ($cartItem) use ($user) {
            $cartItem->update(['user_id' => $user->id, 'guest_id' => null]);
        });
    }
}
