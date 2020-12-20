<?php

namespace App\Orders;

//use App\Billing\PaymentGetwayContract;
use App\Events\NewOrder;
use App\Mail\SendOrder;
use App\Order;
use App\Order_lines;
use App\Product;
use App\Setting;
use App\Shipping_methods;
use App\Sold;
use Cart;
use Mail;
use NumberFormatter;

class OrderDetails
{
    private $PaymentGetwayContract;
    public $shippings_names = [];
    public $shipping        = 0;
    public $subtotal        = 0;
    public $coupons         = 0;
    public $qty             = 0;
    public $carts;


    public function __construct() {
        $this->carts = carts_content();
    }

    public function store($validate = null)
    {
        (session()->get('data') !== null) ? $validate = session()->get('data')[0] : $validate;
        (session()->get('shippings_names') !== null) ? $this->shippings_names = session()->get('shippings_names')[0] : $this->shippings_names;

        //if ($validate['payment_method'] === 'paypal') {
        foreach ($this->carts as $cart) {
            $cart_product = $cart['cart']->getProduct();

            if (!$cart['shipping']) {
                $defaultShipping = Setting::orderBy('id', 'desc')->first();
                if ($defaultShipping->default_shipping == 1) {
                    if ($defaultShipping->shipping !== null) {
                        $ship            = $cart_product->calcShipping($defaultShipping->shipping, $cart['cart']->quantity);
                        $this->shipping += round($ship);
                        $shipping_name   = $defaultShipping->shipping->name;
                    }

                }
            } else {
                $ship            = $cart_product->calcShipping($cart['shipping'], $cart['cart']->quantity);
                $this->shipping += round($ship);
                $shipping_name   = $cart['shipping']->name;

            }

            $this->qty += $cart['cart']->quantity;
            $this->subtotal += $cart['cart']->price * $cart['cart']->quantity;
        }

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
        foreach ($this->carts as $cart) {
            $cart_product = $cart['cart']->getProduct();

            if (!$cart['shipping']) {
                $defaultShipping = Setting::orderBy('id', 'desc')->first();
                if ($defaultShipping->default_shipping == 1) {
                    if ($defaultShipping->shipping !== null) {
                        $ship = $cart_product->calcShipping($defaultShipping->shipping, $cart['cart']->quantity);
                    }
                }
            } else {
                $ship = $cart_product->calcShipping($cart['shipping'], $cart['cart']->quantity);
            }
            Order_lines::create([
                'order_id'         => $order->id,
                'quantity'         => $cart['cart']->quantity,
                'total'            => $cart['cart']->price * $cart['cart']->quantity,
                'price'            => $cart['cart']->price,
                'tax'              => $cart_product->tax * ($cart['cart']->price * $cart['cart']->quantity) / 100,
                'shipping'         => $ship,
                'discount'         => $this->discount($cart['cart']->price, $cart_product),
                'discount_details' => $this->discount_details($cart_product),
                'sku'              => $cart['cart']->buyable->sku,                      // if variation sku not empty
                'product'          => $cart_product->name,
                'options'          => ($cart_product->product_type === 'variable') ? json_encode($cart['cart']->options) : null,
                'seller_id'        => $cart_product->seller_id,
            ]);
            Sold::create([
                'sold'           => $cart['cart']->quantity,
                'sale_price'     => $cart['cart']->price,
                'purchase_price' => $cart['cart']->buyable->purchase_price,
                'fees'           => Setting::latest('id')->first()->fees,
                'coupon'         => ($this->coupons != 0) ? $this->coupons * $cart['cart']->quantity / $this->qty : 0,
                'product_id'     => $cart_product->id,
                'options'        => ($cart_product->product_type === 'variable') ? json_encode($cart['cart']->options) : null,
            ]);
            Product::find($cart_product->id)->decrement('stock', $cart['cart']->quantity);

            }

        Mail::to($validate['billing_email'])->send(new SendOrder($order));
        event(new NewOrder(trans('admin.new_Order')));

        session()->forget('order');
        session()->forget('coupon');
        return session()->push('order', $order);
    }

    public function coupons()
    {
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

    public function discount($price, $product)
    {
        if ($product->available_discount()) {
            if ($product->discount->condition === 'percentage_of_product_price') {

                return $price - ($product->discount->amount / 100 * $price);

            } elseif ($product->discount->condition === 'fixed_amount') {

                return $price - $product->discount->amount;

            }
        }
        return 0;
    }

    public function discount_details($product)
    {
        if ($product->available_discount() && $product->discount->condition === 'buy_x_and_get_y_free') {
            $numberFormat = new NumberFormatter(session('locale'), NumberFormatter::SPELLOUT);

            return 'buy ' . $numberFormat->format($product->discount->y_quantity) . 'and get ' . $numberFormat->format($product->discount->y_quantity)
            . $product->discount->productY->name . ' free';

        }

        return null;
    }

}
