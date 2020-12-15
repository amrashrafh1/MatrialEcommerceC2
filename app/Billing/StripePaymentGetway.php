<?php

namespace App\Billing;

use App\Shipping_methods;
use App\Setting;
use App\Order;
use Str;
use Cart;
use Alert;
use Illuminate\Http\Request;
use App\Orders\OrderDetails;
use Cartalyst\Stripe\Stripe;
use App\Shippings\Shipping;

class StripePaymentGetway implements PaymentGetwayContract
{
    public $shippings_names = [];
    public $shipping        = 0;
    public $subtotal        = 0;
    public $coupons         = 0;
    public $qty             = 0;


    public function charge($validate = null,$token = null) {

        $data             = [];
        $data['items']    = [];
        $data['shipping'] = [];

        if (session()->get('items') !== null) {
            foreach (session()->get('items') as $cart) {
                $cc           = Cart::content()->find($cart['item']);
                $cart_product = $cc->getProduct();
                if($cart_product->product_type == 'variable') {
                    if(check_stock($cc) < $cc->quantity) {
                        if(check_stock($cc) <= 0 || $cart_product->in_stock == 'out_stock') {
                            $slug = $cart_product->slug;
                            Cart::remove($cc->id);
                            session()->forget('items');
                            Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        } else {
                            Cart::update($cc->id, $cart_product->stock);
                        }
                    }
                } else {
                    if($cart_product->stock < $cc->quantity) {
                        if($cart_product->stock <= 0 || $cart_product->in_stock == 'out_stock') {
                            $slug = $cart_product->slug;
                            Cart::remove($cc->id);
                            session()->forget('items');
                            Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        }
                        Cart::update($cc->id, $cart_product->stock);
                    }
                }

                $calcShipping    = new Shipping(Shipping_methods::where('id',$cart['shipping'])->first(), $cc->quantity,$cc->price, $cart_product->weight);
                $shippingMethod  = $calcShipping->shippingMethod();
                $this->shipping += $shippingMethod[0];
                $shipping_name   = $shippingMethod[1];

                $this->qty      += $cc->quantity;
               // $this->shipping += round($ship);
                $this->subtotal += round($cc->price * $cc->quantity);
                array_push($data['items'],
                    [
                        'name'  => 'product name : ' . $cart_product->name,
                        'price' => 'product price : ' . round($cc->price),
                        'qty'   => 'product quantity : ' . $cc->quantity,
                    ]);
                array_push($data['shipping'],
                    [
                        'name' => 'shipping_method: ' . $shipping_name, 'price' => 'Price: ' . round($shippingMethod[0]),
                        'desc' => 'shipping method: ' . $shipping_name, 'qty' => 1,
                    ]);
                array_push($this->shippings_names, $shipping_name);

            }
        } else {
            foreach (Cart::content() as $index => $cart) {
                $cart_product = $cart->getProduct();
                if($cart_product->product_type == 'variable') {
                    if(check_stock($cart) < $cart->quantity) {
                        if(check_stock($cart) <= 0 || $cart_product->in_stock == 'out_stock') {
                            $slug = $cart_product->slug;
                            Cart::remove($cart->id);
                            session()->forget('items');
                            Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        } else {
                            Cart::update($cart->id, $cart_product->stock);
                        }
                    }
                } else {
                    if($cart_product->stock < $cart->quantity) {
                        if($cart_product->stock <= 0 || $cart_product->in_stock == 'out_stock') {
                            $slug = $cart_product->slug;
                            Cart::remove($cart->id);
                            session()->forget('items');
                            Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        }
                        Cart::update($cart->id, $cart_product->stock);
                    }
                }

                $calcShipping    = new Shipping($cart_product->methods->first(), $cart->quantity, $cart->price, $cart_product->weight);
                $shippingMethod  = $calcShipping->shippingMethod();
                $this->shipping += $shippingMethod[0];
                $shipping_name   = $shippingMethod[1];

                $this->qty      += $cart->quantity;
                //$this->shipping += round($ship);
                $this->subtotal += round($cart->price * $cart->quantity);
                array_push($data['items'],
                    [
                        'name'  . $index => 'product name : ' . $cart_product->name,
                        'price' . $index => 'product price : ' . curr($cart->price),
                        'qty'   . $index => 'product quantity : ' . $cart->quantity,
                    ]);
                array_push($data['shipping'],
                    [
                        'name' => 'shipping_method: ' . $shipping_name, 'price' => 'cost: ' . round($shippingMethod[0]),
                        'desc' => 'shipping method: ' . $shipping_name, 'qty' => 1,
                    ]);
                array_push($this->shippings_names, $shipping_name);

            }
        }


        $data['total'] = round($this->subtotal + $this->shipping - $this->discount());
        //dd($this->coupons);
        $stripe = Stripe::make(env('STRIPE_SECRET_KEY'));
        $charge = $stripe->charges()->create([
            'currency' => 'USD',
            'amount'   => $data['total'],
            'source'   => $token,
            'metadata' => [
                'products'  => implode('-------', \Arr::collapse($data['items'])),
                'shippings' => implode('-------', \Arr::collapse($data['shipping'])),
            ],
            'receipt_email' => $validate['billing_email'],
        ]);

        $orderDetails = new OrderDetails();
        $orderDetails->store($validate);
        try {
            if (session()->get('items') !== null) {
                foreach (session()->get('items') as $cart) {
                    Cart::remove($cart['shipping']);
                }
            } else {
                foreach (Cart::content() as $cart) {
                    Cart::remove($cart->id);
                }
            }
            session()->forget('items');
        } catch (\Exeption $e) {

        }
        session()->forget('coupon');
        return redirect()->route('success_page');

    }

    public function discount() {

        if (session()->get('coupon') !== null) {
            foreach (session()->get('coupon') as $coupon) {
                if ($coupon['is_usd'] === 1) {
                    return $this->coupons += $coupon['reward'];
                } else {
                    return $this->coupons += ($this->subtotal + $this->shipping) * $coupon['reward'] / 100;
                }
            }
        }
        return 0;
    }

}
