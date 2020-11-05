<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
class CheckoutController extends Controller
{
    public function __invoke(Request $request, $country_id) {
        $items  = [];
        if(session()->get('items') !== null) {
            foreach(session()->get('items') as $cart) {
                $cart_item = Cart::find($cart['item']);
                if($this->shipping($cart_item->buyable, $country_id)) {
                    array_push($items, ['cart' => $cart_item, 'shipping' => $cart['shipping']]);
                };
            }
        } else {
            foreach(Cart::content() as $cart) {
                if($this->shipping($cart->buyable)) {
                    array_push($items, $cart);
                };
            }
        }
        dd($items);
        $payment = '';
        if($request->payment === 'stripe') {
            $payment = 'stripe';
        } elseif($request->payment === 'paypal') {
            $payment = 'paypal';
        }
        return view('FrontEnd.checkout', ['payment' => $payment, 'items'=> $items]);
    }


    protected function shipping ($product, $country_id) {
        $methods    = $product->methods()->whereHas('zone', function ($q) use ($country_id) {
            $q->whereHas('countries', function ($query) use ($country_id) {
                $query->where('id', $country_id);
        });
        })->get();
        if (count($methods) <= 0) {
            // will get the default shipping method if has this country
            $defaultShipping = config('app.setting');
            if ($defaultShipping->default_shipping == 1 && $defaultShipping->shipping !== null) {

                    $isDefaultMethod = $defaultShipping->shipping()->whereHas('zone', function ($q) use ($country_id) {
                        $q->whereHas('countries', function ($query) use ($country_id) {
                            $query->where('id', $country_id);
                        });
                    })->first();
                    // push $defaultShipping to shippings array
                    if ($isDefaultMethod !== null) {
                        return true;
                    } else {
                        // if $defaultShipping empty remove this item from items array
                        return false;
                    }


            }
            // if $defaultShipping empty remove this item from items array
            if ($defaultShipping->default_shipping != 1 || $defaultShipping->shipping == null) {
                return false;
            }
        } else {
            return true;
        }
    }
}
