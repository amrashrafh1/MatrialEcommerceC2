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


        if (session()->get('items') !== null) {

            foreach (session()->get('items') as $cart) {
                $cc = Cart::content()->find($cart['item']);
                if($cc->buyable->product_type == 'variable') {
                    if(check_stock($cc) < $cc->quantity) {
                        if(check_stock($cc) <= 0 || $cc->buyable->in_stock == 'out_stock') {
                            $slug = $cc->buyable->slug;
                            Cart::remove($cc->id);
                            session()->forget('items');
                            Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        } else {
                            Cart::update($cc->id, $cc->buyable->stock);
                        }
                    }
                } else {
                    if($cc->buyable->stock < $cc->quantity) {
                        if($cc->buyable->stock <= 0 || $cc->buyable->in_stock == 'out_stock') {
                            $slug = $cc->buyable->slug;
                            Cart::remove($cc->id);
                            session()->forget('items');
                            Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        }
                        Cart::update($cc->id, $cc->buyable->stock);
                    }
                }
                $calcShipping    = new Shipping(Shipping_methods::where('id',$cart['shipping'])->first(), $cc->quantity,$cc->price, $cc->buyable->weight);
                $shippingMethod  = $calcShipping->shippingMethod();
                $this->shipping += $shippingMethod[0];
                $shipping_name   = $shippingMethod[1];


                $this->subtotal += round($cc->price * $cc->quantity);
                array_push($data['items'],
                    [
                        'name' => $cc->buyable->name, 'price' => round($cc->price),
                        'desc' => 'description:' . $cc->buyable->name, 'qty' => $cc->quantity,
                    ]);
                array_push($data['items'],
                    [
                        'name' => 'shipping_method: ' . $shipping_name, 'price' => round($shippingMethod[0]),
                        'desc' => 'shipping method: ' . $shipping_name, 'qty' => 1,
                    ]);
                    array_push($this->shippings_names, $shipping_name);

            }
        } else {
            foreach (Cart::content() as $cart) {
                if($cart->buyable->product_type == 'variable') {
                    if(check_stock($cart) < $cart->quantity) {
                        if(check_stock($cart) <= 0 || $cart->buyable->in_stock == 'out_stock') {
                            $slug = $cart->buyable->slug;
                            Cart::remove($cart->id);
                            session()->forget('items');
                            Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        } else {
                            Cart::update($cart->id, $cart->buyable->stock);
                        }
                    }
                } else {
                    if($cart->buyable->stock < $cart->quantity) {
                        if($cart->buyable->stock <= 0 || $cart->buyable->in_stock == 'out_stock') {
                            $slug = $cart->buyable->slug;
                            Cart::remove($cart->id);
                            session()->forget('items');
                            Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        }
                        Cart::update($cart->id, $cart->buyable->stock);
                    }
                }

                $calcShipping    = new Shipping($cart->buyable->methods->first(), $cart->quantity, $cart->price, $cart->buyable->weight);
                $shippingMethod  = $calcShipping->shippingMethod();
                $this->shipping += $shippingMethod[0];
                $shipping_name   = $shippingMethod[1];

                $this->subtotal += round($cart->price * (int)$cart->quantity);


                array_push($data['items'],
                    [
                        'name' => $cart->buyable->name,                   'price' => round($cart->price),
                        'desc' => 'description: ' . $cart->buyable->name, 'qty'   => (int)$cart->quantity,
                    ]);
                array_push($data['items'],
                    [
                        'name' => 'shipping_method: ' . $shipping_name, 'price' => round($shippingMethod[0]),
                        'desc' => 'shipping method: ' . $shipping_name, 'qty' => 1,
                    ]);
                array_push($this->shippings_names, $shipping_name);

            }
        }



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
            //dd('asdfsadf');
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
}
