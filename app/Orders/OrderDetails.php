<?php

namespace App\Orders;
//use App\Billing\PaymentGetwayContract;
use App\Order;
use App\Product;
use App\Sold;
use App\Order_lines;
use App\Setting;
use Cart;
class OrderDetails
{
    private $PaymentGetwayContract;
    public $shippings_names = [];
    public $shipping        = 0;
    public $subtotal        = 0;
    public $coupons         = 0;
    public $qty             = 0;



    public function store($validate = null) {
//dd('asdfadsf');
        (session()->get('data') !== null)?$validate = session()->get('data')[0]:$validate;
        (session()->get('shippings_names') !== null)?$this->shippings_names = session()->get('shippings_names')[0]:$this->shippings_names;


        //if ($validate['payment_method'] === 'paypal') {
            if (session()->get('items') !== null) {
                foreach (session()->get('items') as $cart) {
                    $cc              = Cart::content()->find($cart['item']);

                    $sh = Shipping_methods::where('id',$cart['shipping'])->first();

                    if(!$sh ) {
                    $defaultShipping = Setting::orderBy('id','desc')->first();
                    if($defaultShipping->default_shipping == 1) {
                        if($defaultShipping->shipping !== null) {
                            $ship =  $cart->buyable->calcShipping($defaultShipping->shipping, $cart->quantity);
                            $this->shipping += round($ship);
                            $shipping_name = $defaultShipping->shipping->name;
                        }

                    }
                    } else {
                        $ship = $cc->buyable->calcShipping(Shipping_methods::find($cart['shipping']), $cc->quantity);
                        $this->shipping += round($ship);
                        $shipping_name = Shipping_methods::find($cart['shipping'])->name;

                    }

                    $this->qty      += $cc->quantity;
                    $this->subtotal += $cc->price * $cc->quantity;
                }
            } else {
                foreach (Cart::content() as $cart) {
                    $sh = $cart->buyable->methods->first();
                    if(!$sh ) {
                    $defaultShipping = Setting::orderBy('id','desc')->first();
                    if($defaultShipping->default_shipping == 1) {
                        if($defaultShipping->shipping !== null) {
                            $ship =  $cart->buyable->calcShipping($defaultShipping->shipping, $cart->quantity);
                            $this->shipping += round($ship);
                        }

                    }
                    } else {
                        $ship            = $cart->buyable->calcShipping($cart->buyable->methods->first(), (int)$cart->quantity);
                        $this->shipping += round($ship);
                    }
                    $this->qty      += $cart->quantity;
                    $this->subtotal += $cart->price * $cart->quantity;

                }
            }
        //}

        $this->coupons();
        $order = Order::create([
            'status'               => 'pending',
            'notes'                => (!empty($validate['order_comments'])) ? $validate['order_comments'] : null,
            'sub_total'            => $this->subtotal,
            'shipping_total'       => $this->shipping,
            'grand_total'          => $this->subtotal + $this->shipping - $this->coupons,
            'coupon'               => $this->coupons,
            'shipping_method'      => implode(',', $this->shippings_names),
            'billing_phone'        => $validate['billing_phone'],
            'billing_name'         => $validate['billing_first_name'] . ' ' . $validate['billing_last_name'],
            'billing_email'        => $validate['billing_email'],
            'billing_address'      => $validate['billing_address_1'],
            'billing_address_two'  => (!empty($validate['billing_address_2'])) ? $validate['billing_address_2'] : null,
            'billing_city'         => $validate['billing_city'],
            'billing_state'        => $validate['billing_state'],
            'billing_country'      => $validate['billing_country'],
            'billing_zip'          => $validate['billing_postcode'],
            'shipping_phone'       => (!empty($validate['shipping_phone'])) ? $validate['shipping_phone'] : null,
            'shipping_name'        => (!empty($validate['shipping_first_name'])) ? $validate['shipping_first_name'] . ' ' . $validate['shipping_last_name'] : null,
            'shipping_email'       => (!empty($validate['shipping_email'])) ? $validate['shipping_email'] : null,
            'shipping_address'     => (!empty($validate['shipping_address_1'])) ? $validate['shipping_address_1'] : null,
            'shipping_address_two' => (!empty($validate['shipping_address_2'])) ? $validate['shipping_address_2'] : null,
            'shipping_city'        => (!empty($validate['shipping_city'])) ? $validate['shipping_city'] : null,
            'shipping_state'       => (!empty($validate['shipping_state'])) ? $validate['shipping_state'] : null,
            'shipping_country'     => (!empty($validate['shipping_country'])) ? $validate['shipping_country'] : null,
            'shipping_zip'         => (!empty($validate['shipping_postcode'])) ? $validate['shipping_postcode'] : null,
            'user_id'              => (\Auth::check()) ? auth()->user()->id : null,
            'payment_method'       => (!empty($validate['payment_method'])) ? $validate['payment_method'] : null,
        ]);
        if (session()->get('items') !== null) {
            foreach (session()->get('items') as $cart) {
                $cc = Cart::content()->find($cart['item']);

                $sh = Shipping_methods::where('id',$cart['shipping'])->first();

                if(!$sh ) {
                $defaultShipping = Setting::orderBy('id','desc')->first();
                if($defaultShipping->default_shipping == 1) {
                    if($defaultShipping->shipping !== null) {
                        $ship =  $cart->buyable->calcShipping($defaultShipping->shipping, $cart->quantity);
                    }
                }
                } else {
                    $ship = $cc->buyable->calcShipping(Shipping_methods::find($cart['shipping']), $cc->quantity);
                }
                Order_lines::create([
                    'order_id'  => $order->id,
                    'quantity'  => $cc->quantity,
                    'total'     => $cc->price * $cc->quantity,
                    'price'     => $cc->price,
                    'tax'       => $cc->buyable->tax * ($cc->price * $cc->quantity) / 100,
                    'shipping'  => $ship,
                    'discount'  => $this->discount($cc->buyable),
                    'sku'       => $cc->buyable->sku,
                    'product'   => $cc->buyable->name,
                    'options'   => ($cc->buyable->product_type === 'variable') ? json_encode($cc->options) : null,
                    'seller_id' => $cc->buyable->user_id,
                ]);
                Sold::create([
                    'sold'           => $cc->quantity,
                    'sale_price'     => $cc->price,
                    'purchase_price' => get_purchase_price($cc),
                    'fees'           => Setting::latest('id')->first()->fees,
                    'coupon'         => ($this->coupons != 0)?$this->coupons * $cc->quantity / $this->qty:0,
                    'product_id'     => $cc->buyable->id,
                    'options'        => ($cc->buyable->product_type === 'variable') ? json_encode($cc->options) : null,
                ]);
                Product::find($cc->buyable->id)->decrement('stock', $cc->quantity);

            }

        } else {
            foreach (Cart::content() as $cart) {

                $sh = $cart->buyable->methods->first();
                if(!$sh ) {
                $defaultShipping = Setting::orderBy('id','desc')->first();
                if($defaultShipping->default_shipping == 1) {
                    if($defaultShipping->shipping !== null) {
                        $ship =  $cart->buyable->calcShipping($defaultShipping->shipping, $cart->quantity);
                    }

                }
                } else {
                    $ship            = $cart->buyable->calcShipping($cart->buyable->methods->first(), (int)$cart->quantity);
                }
                Order_lines::create([
                    'order_id'  => $order->id,
                    'quantity'  => $cart->quantity,
                    'total'     => $cart->price * $cart->quantity,
                    'price'     => $cart->price,
                    'tax'       => $cart->buyable->tax * ($cart->price * $cart->quantity) / 100,
                    'shipping'  => $ship,
                    'discount'  => $this->discount($cart->buyable),
                    'sku'       => $cart->buyable->sku,
                    'product'   => $cart->buyable->name,
                    'options'   => ($cart->buyable->product_type === 'variable') ? json_encode($cart->options) : null,
                    'seller_id' => $cart->buyable->user_id,
                ]);
                Sold::create([
                    'sold'           => $cart->quantity,
                    'sale_price'     => $cart->price,
                    'purchase_price' => get_purchase_price($cart),
                    'fees'           => Setting::latest('id')->first()->fees,
                    'coupon'         => ($this->coupons != 0)?$this->coupons * $cart->quantity / $this->qty:0,
                    'product_id'     => $cart->buyable->id,
                    'options'        => ($cart->buyable->product_type === 'variable') ? json_encode($cart->options) : null,
                ]);
                Product::find($cart->buyable->id)->decrement('stock', $cart->quantity);
            }
        }
        //Mail::to($data['billing_email'])->send(new Mail);

        session()->forget('order');
        session()->forget('coupon');
        return session()->push('order', $order);
    }


    public function coupons() {
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

    public function discount($product) {
         if ($product->available_discount()) {

            if ($product->discount->condition === 'percentage_of_product_price') {

                return $product->discount->amount / 100 * $product->sale_price;

            } elseif ($product->discount->condition === 'fixed_amount') {

                return $product->discount->amount;

            }
        }
        return 0;
    }

}
