<?php

namespace App\Billing;

use Alert;
use App\Orders\OrderDetails;
use App\Shippings\Shipping;
use Cart;
use App\Attribute;
use Cartalyst\Stripe\Stripe;

class StripePaymentGetway implements PaymentGetwayContract
{
    public $shippings_names = [];
    public $shipping = 0;
    public $subtotal = 0;
    public $coupons = 0;
    public $qty = 0;

    public function charge($validate = null, $token = null)
    {

        $data = [];
        $data['items'] = [];
        $data['shipping'] = [];
        try {
            foreach (carts_content() as $cart) {
                $cart_product = $cart['cart']->getProduct();
                if ($cart_product->isVariable()) {
                    if ($cart['cart']->buyable->stock < $cart['cart']->quantity) {
                        if ($cart['cart']->buyable->stock <= 0 || $cart['cart']->buyable->in_stock == 'out_stock') {
                            $slug = $cart_product->slug;
                            Cart::remove($cart['cart']->id);
                            session()->forget('items');
                            Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product', $slug)->with('out_stock', trans('user.this_product_is_out_of_stock'));
                        } else {
                            Cart::update($cart['cart']->id, $cart['cart']->quantity);
                        }
                    }
                } else {
                    if ($cart['cart']->buyable->stock < $cart['cart']->quantity) {
                        if ($cart['cart']->buyable->stock <= 0 || $cart['cart']->buyable->in_stock == 'out_stock') {
                            $slug = $cart_product->slug;
                            Cart::remove($cart['cart']->id);
                            session()->forget('items');
                            Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product', $slug)->with('out_stock', trans('user.this_product_is_out_of_stock'));
                        }
                        Cart::update($cart['cart']->id, $cart['cart']->quantity);
                    }
                }
                // shipping
                $calcShipping    = new Shipping($cart['shipping'], $cart['cart']->quantity, $cart['cart']->price, $cart_product->weight);
                $shippingMethod  = $calcShipping->shippingMethod();
                $this->shipping += $this->format_currency($shippingMethod[0]);
                $shipping_name   = $shippingMethod[1];

                $this->qty      += $cart['cart']->quantity;
                $this->subtotal += $this->format_currency($cart['cart']->price * $cart['cart']->quantity);
                $options         = [];

                if ($cart_product->IsVariable()) {
                    foreach ($cart['cart']->options as $key => $val) {
                        $attribute = Attribute::where('id', $val)->first();
                        if ($attribute) {
                            array_push($options, $attribute->attribute_family->name . ' : ' . $attribute->name);
                        }
                    }
                }

                array_push($data['items'],
                    [
                        'name'    => 'product name : ' . $cart_product->name,
                        'price'   => 'product price : ' . $this->format_currency($cart['cart']->price),
                        'options' => 'product options : ' . implode('  ---  ', $options),
                        'qty'     => 'product quantity : ' . $cart['cart']->quantity,
                    ]);
                array_push($data['shipping'],
                    [
                        'name' => 'shipping_method: ' . $shipping_name, 'price' => 'Price: ' . $this->format_currency($shippingMethod[0]),
                        'desc' => 'shipping method: ' . $shipping_name, 'qty' => 1,
                    ]);
                array_push($this->shippings_names, $shipping_name);

            }

        $data['total'] = $this->subtotal + $this->shipping - $this->format_currency($this->discount());

        $stripe = Stripe::make(env('STRIPE_SECRET_KEY'));
        $charge = $stripe->charges()->create([
            'currency' => currency()->getUserCurrency(),
            'amount'   => $data['total'],
            'source'   => $token,
            'metadata' => [
                'products' => implode('    ---    ', \Arr::collapse($data['items'])),
                'shippings' => implode('    ---    ', \Arr::collapse($data['shipping'])),
            ],
            'receipt_email' => $validate['billing_email'],
        ]);

        $orderDetails = new OrderDetails();
        $orderDetails->store($validate);
        try {
            foreach (carts_content() as $cart) {
                Cart::remove($cart['cart']->id);
            }
            session()->forget('items');
        } catch (\Exeption $e) {

        }
        session()->forget('coupon');
        return redirect()->route('success_page');

    } catch(\Exception $e) {

        return redirect()->route('fail_page',  $e->getMessage());
    }

    }

    public function discount()
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

    protected function format_currency($price) {
        return number_format(currency(floatVal($price), 'USD', strip_tags(currency()->getUserCurrency()), false), 2, '.', '');
    }
}
