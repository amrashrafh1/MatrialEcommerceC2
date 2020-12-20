<?php

namespace App\Billing;

use App\Shipping_methods;
use App\Setting;
use App\Order;
use Str;
use Cart;
use Alert;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Request;
use App\Orders\OrderDetails;
use App\Shippings\Shipping;
use App\Attribute;

class PaypalPaymentGetway implements PaymentGetwayContract
{

    public $shippings_names = [];
    public $shipping        = 0;
    public $subtotal        = 0;
    public $coupons         = 0;
    protected $provider;



    public function __construct()
    {
        $this->provider = new ExpressCheckout();
    }


    public function charge($validate = NULL, $token = NULL) {

        $data           = [];
        $data['items']  = [];
try {



        $carts = carts_content();
        foreach ($carts as $cart) {
            $cart_product = $cart['cart']->getProduct();

            if($cart_product->isVariable()) {
                if($cart['cart']->buyable->stock < $cart['cart']->quantity) {
                    if($cart['cart']->buyable->stock <= 0 || $cart['cart']->buyable->in_stock == 'out_stock') {
                        $slug = $cart_product->slug;
                        Cart::remove($cart['cart']->id);
                        session()->forget('items');
                        Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                        return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                    } else {
                        Cart::update($cart['cart']->id, $cart['cart']->quantity);
                    }
                }
            } else {
                if($cart['cart']->buyable->stock < $cart['cart']->quantity) {
                    if($cart['cart']->buyable->stock <= 0 || $cart['cart']->buyable->in_stock == 'out_stock') {
                        $slug = $cart_product->slug;
                        Cart::remove($cart['cart']->id);
                        session()->forget('items');
                        Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                        return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                    }
                    Cart::update($cart['cart']->id, $cart['cart']->quantity);
                }
            }
            $calcShipping    = new Shipping($cart['shipping'], $cart['cart']->quantity,$cart['cart']->price, $cart_product->weight);
            $shippingMethod  = $calcShipping->shippingMethod();
            $this->shipping += $this->format_currency($shippingMethod[0]);
            $shipping_name   = $shippingMethod[1];
            $options         = [];

            if ($cart_product->IsVariable()) {
                foreach ($cart['cart']->options as $key => $val) {
                    $attribute = Attribute::where('id', $val)->first();
                    if ($attribute) {
                        array_push($options, $attribute->attribute_family->name . ' : ' . $attribute->name);
                    }
                }
            }

            $this->subtotal += $this->format_currency($cart['cart']->price * $cart['cart']->quantity);

            array_push($data['items'],
                [
                    'name' => $cart_product->name, 'price' => $this->format_currency($cart['cart']->price),
                    'desc' => 'options:' . implode('  ---  ', $options), 'qty' => $cart['cart']->quantity,
                ]);
            array_push($data['items'],
                [
                    'name' => 'shipping_method: ' . $shipping_name, 'price' => $this->format_currency($shippingMethod[0]),
                    'desc' => 'shipping method: ' . $shipping_name, 'qty' => 1,
                ]);
                array_push($this->shippings_names, $shipping_name);

        }
        $last_order = \App\Order::orderBy('id', 'desc')->first();

        $data['invoice_id']          = ($last_order)? $last_order->id + 1: 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url']          = route('payment.success');
        $data['cancel_url']          = route('payment.cancel');
        $data['shipping_discount']   = $this->format_currency($this->discount());
        $data['total']               = $this->subtotal + $this->shipping;

        session()->forget('cartsData');
        session()->push('cartsData', $data);
        session()->forget('shippings_names');
        session()->push('shippings_names', $this->shippings_names);

        $response = $this->provider->setCurrency(currency()->getUserCurrency())->setExpressCheckout($data);
        if(blank($response['paypal_link'])){

            return redirect()->route('fail_page', $response['L_LONGMESSAGE0']);

        }
        return redirect($response['paypal_link']);

    } catch(\Exception $e) {

        return redirect()->route('fail_page',  $e->getMessage());
    }
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


    public function cancel()
    {
        return view('FrontEnd.fail_page');
    }

    public function success(Request $request)
    {
        $response = $this->provider->getExpressCheckoutDetails($request->token);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $token   = $request->get('token');
            $PayerID = $request->get('PayerID');
            $this->provider->doExpressCheckoutPayment(session()->get('cartsData')[0], $token, $PayerID);

            $orderDetails = new OrderDetails();
            $orderDetails->store();
            try {
                session()->forget('data');
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

        return redirect()->route('fail_page');
    }


    protected function format_currency($price) {
        return number_format(currency(floatVal($price), 'USD', strip_tags(currency()->getUserCurrency()), false), 2, '.', '');
    }
}
