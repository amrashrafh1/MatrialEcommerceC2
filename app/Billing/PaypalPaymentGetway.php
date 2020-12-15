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


        $carts = $this->carts();
        foreach ($carts as $cart) {
            $cart_product = $cart->getProduct();

            if($cart_product->isVariable()) {
                if(check_stock($cart) < $cart->quantity) {
                    if(check_stock($cart) <= 0 || $cart->in_stock == 'out_stock') {
                        $slug = $cart_product->slug;
                        Cart::remove($cart->id);
                        session()->forget('items');
                        Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                        return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                    } else {
                        Cart::update($cart->id, $cart->stock);
                    }
                }
            } else {
                if($cart->stock < $cart->quantity) {
                    if($cart->stock <= 0 || $cart->in_stock == 'out_stock') {
                        $slug = $cart_product->slug;
                        Cart::remove($cart->id);
                        session()->forget('items');
                        Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                        return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                    }
                    Cart::update($cart->id, $cart_product->stock);
                }
            }
            $calcShipping    = new Shipping(Shipping_methods::where('id',$cart['shipping'])->first(), $cart->quantity,$cart->price, $cart_product->weight);
            $shippingMethod  = $calcShipping->shippingMethod();
            $this->shipping += $shippingMethod[0];
            $shipping_name   = $shippingMethod[1];


            $this->subtotal += round($cart->price * $cart->quantity);
            array_push($data['items'],
                [
                    'name' => $cart_product->name, 'price' => round($cart->price),
                    'desc' => 'description:' . $cart_product->name, 'qty' => $cart->quantity,
                ]);
            array_push($data['items'],
                [
                    'name' => 'shipping_method: ' . $shipping_name, 'price' => round($shippingMethod[0]),
                    'desc' => 'shipping method: ' . $shipping_name, 'qty' => 1,
                ]);
                array_push($this->shippings_names, $shipping_name);

        }
/*         if (session()->get('items') !== null) {
 */

        /* } else {
            foreach (Cart::content() as $cart) {
                $cart_product = $cart->getProduct();
                if($cart_product->product_type == 'variable') {
                    if(check_stock($cart) < $cart->quantity) {
                        if(check_stock($cart) <= 0 || $cart->buyable->in_stock == 'out_stock') {
                            $slug = $cart_product->slug;
                            Cart::remove($cart->id);
                            session()->forget('items');
                            Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        } else {
                            Cart::update($cart->id, $cc->buyable->stock);
                        }
                    }
                } else {
                    if($cart->buyable->stock < $cart->quantity) {
                        if($cart->buyable->stock <= 0 || $cart->buyable->in_stock == 'out_stock') {
                            $slug = $cart_product->slug;
                            Cart::remove($cart->id);
                            session()->forget('items');
                            Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        }
                        Cart::update($cart->id, $cart->buyable->stock);
                    }
                }

                $calcShipping    = new Shipping($cart_product->methods->first(), $cart->quantity, $cart->price, $cart_product->weight);
                $shippingMethod  = $calcShipping->shippingMethod();
                $this->shipping += $shippingMethod[0];
                $shipping_name   = $shippingMethod[1];

                $this->subtotal += round($cart->price * (int)$cart->quantity);


                array_push($data['items'],
                    [
                        'name' => $cart_product->name,                   'price' => round($cart->price),
                        'desc' => 'description: ' . $cart_product->name, 'qty'   => (int)$cart->quantity,
                    ]);
                array_push($data['items'],
                    [
                        'name' => 'shipping_method: ' . $shipping_name, 'price' => round($shippingMethod[0]),
                        'desc' => 'shipping method: ' . $shipping_name, 'qty' => 1,
                    ]);
                array_push($this->shippings_names, $shipping_name);

            }
        } */



        $data['invoice_id']          = rand();
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url']          = route('payment.success');
        $data['cancel_url']          = route('payment.cancel');
        $data['shipping_discount']   = $this->discount();
        $data['total']               = round($this->subtotal + $this->shipping);


        session()->forget('cartsData');
        session()->push('cartsData', $data);
        session()->forget('shippings_names');
        session()->push('shippings_names', $this->shippings_names);
        $response = $this->provider->setExpressCheckout($data);
        return redirect($response['paypal_link']);

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
        dd('Your payment is canceled. You can create cancel page here.');
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


    protected function carts() {
        if (session()->get('items') !== null) {
            $carts = [];
            foreach(session()->get('items') as $cart) {
                array_push($carts, Cart::content()->find($cart['item']));
            }
            return collect($carts);
        }
        return Cart::content();
    }
}
