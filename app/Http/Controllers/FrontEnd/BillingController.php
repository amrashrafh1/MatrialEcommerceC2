<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Order;
use App\Order_lines;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Events\NewOrder;
use App\Shipping_methods;
use App\Sold;
use App\Setting;
use App\Product;

class BillingController extends Controller
{

    public $subtotal        = 0;
    public $shipping        = 0;
    public $coupons         = 0;
    public $tax             = 0;
    public $qty             = 0;
    public $shippings_names = [];
    protected $provider;

    public function __construct()
    {
        $this->provider = new ExpressCheckout();
    }

    public function store(Request $request)
    {
        $validate = $this->validate(request(), [

            'billing_first_name' => 'required|string',
            'billing_last_name'  => 'required|string',
            'billing_country'    => 'required|numeric|exists:countries,id',
            'billing_address_1'  => 'required|string',
            'billing_address_2'  => 'sometimes|nullable|string',
            'billing_city'       => 'required|string',
            'billing_state'      => 'required|string',
            'billing_postcode'   => 'required|string',
            'billing_phone'      => 'required|string',
            'billing_email'      => 'required|email',

            'shipping_country'   => 'sometimes|nullable|numeric|exists:countries,id',
            'shipping_address_1' => 'sometimes|nullable|string',
            'shipping_address_2' => 'sometimes|nullable|string',
            'shipping_city'      => 'sometimes|nullable|string',
            'shipping_state'     => 'sometimes|nullable|string',
            'shipping_postcode'  => 'sometimes|nullable|string',
            'shipping_phone'     => 'sometimes|nullable|string',
            'shipping_email'     => 'sometimes|nullable|email',
            'order_comments'     => 'sometimes|nullable|string',

            'payment_method' => 'required|string',
            'terms'          => 'required|in:on,off',
        ], [], [

            'billing_first_name' => trans('user.first_name'),
            'billing_last_name'  => trans('user.last_name'),
            'billing_country'    => trans('user.country'),
            'billing_address_1'  => trans('user.address'),
            'billing_address_2'  => trans('user.address'),
            'billing_city'       => trans('user.city'),
            'states'             => trans('user.states'),
            'billing_postcode'   => trans('user.postcode'),
            'billing_phone'      => trans('user.phone'),
            'billing_email'      => trans('user.email'),

            'shipping_country'   => trans('user.shipping_country'),
            'shipping_address_1' => trans('user.shipping_address'),
            'shipping_address_2' => trans('user.shipping_address'),
            'shipping_city'      => trans('user.shipping_city'),
            'shipping_postcode'  => trans('user.shipping_postcode'),
            'shipping_email'     => trans('user.shipping_email'),
            'shipping_phone'     => trans('user.shipping_phone'),
            'order_comments'     => trans('user.order_notes'),

            'payment_method' => trans('user.payment_method'),
            'terms'          => trans('user.terms'),
        ]);
        if ($validate['payment_method'] === 'paypal') {
            return $this->paypal_checkout($validate);

        } else {
            return $this->stripe_checkout($validate, $request->stripeToken);
        }

    }

    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }

    public function success(Request $request)
    {
        $response = $this->provider->getExpressCheckoutDetails($request->token);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $token = $request->get('token');
            $PayerID = $request->get('PayerID');
            $this->provider->doExpressCheckoutPayment(session()->get('cartsData')[0], $token, $PayerID);

            $this->store_orders();
            try {
                session()->forget('data');
                if (session()->get('items') !== null) {
                    foreach (session()->get('items') as $cart) {
                        \Cart::remove($cart['shipping']);
                    }
                } else {
                    foreach (\Cart::content() as $cart) {
                        \Cart::remove($cart->id);
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

    protected function paypal_checkout($validate)
    {
        $this->shipping = 0;
        $this->subtotal = 0;
        $this->coupons  = 0;
        $data           = [];
        session()->forget('data');
        session()->push('data', $validate);

        $data['items'] = [];

        if (session()->get('items') !== null) {
            foreach (session()->get('items') as $cart) {
                $cc = \Cart::content()->find($cart['item']);
                if($cc->buyable->product_type == 'variable') {
                    if(check_stock($cc) < $cc->quantity) {
                        if(check_stock($cc) <= 0 || $cc->buyable->in_stock == 'out_stock') {
                            $slug = $cc->buyable->slug;
                            \Cart::remove($cc->id);
                            session()->forget('items');
                            \Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        } else {
                            \Cart::update($cc->id, $cc->buyable->stock);
                        }
                    }
                } else {
                    if($cc->buyable->stock < $cc->quantity) {
                        if($cc->buyable->stock <= 0 || $cc->buyable->in_stock == 'out_stock') {
                            $slug = $cc->buyable->slug;
                            \Cart::remove($cc->id);
                            session()->forget('items');
                            \Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        }
                        \Cart::update($cc->id, $cc->buyable->stock);
                    }
                }
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
                $this->subtotal += round($cc->price * $cc->quantity);
                array_push($data['items'],
                    [
                        'name' => $cc->buyable->name, 'price' => round($cc->price),
                        'desc' => 'description:' . $cc->buyable->name, 'qty' => $cc->quantity,
                    ]);
                array_push($data['items'],
                    [
                        'name' => 'shipping_method: ' . $shipping_name, 'price' => round($ship),
                        'desc' => 'shipping method: ' . $shipping_name, 'qty' => 1,
                    ]);
                    array_push($this->shippings_names, $shipping_name);

            }
        } else {
            foreach (\Cart::content() as $cart) {
                if($cart->buyable->product_type == 'variable') {
                    if(check_stock($cart) < $cart->quantity) {
                        if(check_stock($cart) <= 0 || $cart->buyable->in_stock == 'out_stock') {
                            $slug = $cart->buyable->slug;
                            \Cart::remove($cart->id);
                            session()->forget('items');
                            \Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        } else {
                            \Cart::update($cart->id, $cart->buyable->stock);
                        }
                    }
                } else {
                    if($cart->buyable->stock < $cart->quantity) {
                        if($cart->buyable->stock <= 0 || $cart->buyable->in_stock == 'out_stock') {
                            $slug = $cart->buyable->slug;
                            \Cart::remove($cart->id);
                            session()->forget('items');
                            \Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        }
                        \Cart::update($cart->id, $cart->buyable->stock);
                    }
                }
                $sh = $cart->buyable->methods->first();
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
                    $ship            = $cart->buyable->calcShipping($cart->buyable->methods->first(), (int)$cart->quantity);
                    $this->shipping += round($ship);
                }
                $this->subtotal += round($cart->price * (int)$cart->quantity);
                array_push($data['items'],
                    [
                        'name' => $cart->buyable->name,                   'price' => round($cart->price),
                        'desc' => 'description: ' . $cart->buyable->name, 'qty'   => (int)$cart->quantity,
                    ]);
                array_push($data['items'],
                    [
                        'name' => 'shipping_method: ' . $shipping_name, 'price' => round($ship),
                        'desc' => 'shipping method: ' . $shipping_name, 'qty' => 1,
                    ]);
                    array_push($this->shippings_names, $shipping_name);

            }
        }

        if (session()->get('coupon') !== null) {
            foreach (session()->get('coupon') as $coupon) {
                if ($coupon['is_usd'] === 1) {
                    $this->coupons += $coupon['reward'];
                } else {
                    $this->coupons += ($this->subtotal + $this->shipping) * $coupon['reward'] / 100;
                }
            }
        }

        $data['invoice_id']          = (Order::latest('id')->first())?Order::latest('id')->first()->id +1: 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url']          = route('payment.success');
        $data['cancel_url']          = route('payment.cancel');
        $data['shipping_discount']   = round($this->coupons);
        $data['total']               = round($this->subtotal + $this->shipping);


        session()->forget('cartsData');
        session()->push('cartsData', $data);
        session()->forget('shippings_names');
        session()->push('shippings_names', $this->shippings_names);
        $response = $this->provider->setExpressCheckout($data);
        return redirect($response['paypal_link']);
    }

    protected function stripe_checkout($validate, $token)
    {
        $this->shipping = 0;
        $this->subtotal = 0;
        $this->coupons  = 0;
        $data           = [];

        $data['items'] = [];
        $data['shipping'] = [];

        if (session()->get('items') !== null) {
            foreach (session()->get('items') as $cart) {
                $cc = \Cart::content()->find($cart['item']);
                if($cc->buyable->product_type == 'variable') {
                    if(check_stock($cc) < $cc->quantity) {
                        if(check_stock($cc) <= 0 || $cc->buyable->in_stock == 'out_stock') {
                            $slug = $cc->buyable->slug;
                            \Cart::remove($cc->id);
                            session()->forget('items');
                            \Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        } else {
                            \Cart::update($cc->id, $cc->buyable->stock);
                        }
                    }
                } else {
                    if($cc->buyable->stock < $cc->quantity) {
                        if($cc->buyable->stock <= 0 || $cc->buyable->in_stock == 'out_stock') {
                            $slug = $cc->buyable->slug;
                            \Cart::remove($cc->id);
                            session()->forget('items');
                            \Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        }
                        \Cart::update($cc->id, $cc->buyable->stock);
                    }
                }
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
               // $this->shipping += round($ship);
                $this->subtotal += round($cc->price * $cc->quantity);
                array_push($data['items'],
                    [
                        'name'  => 'product name : ' . $cc->buyable->name,
                        'price' => 'product price : ' . round($cc->price),
                        'qty'   => 'product quantity : ' . $cc->quantity,
                    ]);
                array_push($data['shipping'],
                    [
                        'name' => 'shipping_method: ' . $shipping_name, 'price' => 'Price: ' . round($ship),
                        'desc' => 'shipping method: ' . $shipping_name, 'qty' => 1,
                    ]);
                array_push($this->shippings_names, $shipping_name);

            }
        } else {
            foreach (\Cart::content() as $index => $cart) {
                if($cart->buyable->product_type == 'variable') {
                    if(check_stock($cart) < $cart->quantity) {
                        if(check_stock($cart) <= 0 || $cart->buyable->in_stock == 'out_stock') {
                            $slug = $cart->buyable->slug;
                            \Cart::remove($cart->id);
                            session()->forget('items');
                            \Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        } else {
                            \Cart::update($cart->id, $cart->buyable->stock);
                        }
                    }
                } else {
                    if($cart->buyable->stock < $cart->quantity) {
                        if($cart->buyable->stock <= 0 || $cart->buyable->in_stock == 'out_stock') {
                            $slug = $cart->buyable->slug;
                            \Cart::remove($cart->id);
                            session()->forget('items');
                            \Alert::warning(trans('user.Alert'), trans('user.this_product_is_out_of_stock'));
                            return redirect()->route('show_product',$slug)->with('out_stock',trans('user.this_product_is_out_of_stock'));
                        }
                        \Cart::update($cart->id, $cart->buyable->stock);
                    }
                }

                $sh = $cart->buyable->methods->first();
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
                    $ship            = $cart->buyable->calcShipping($cart->buyable->methods->first(), (int)$cart->quantity);
                    $this->shipping += round($ship);
                    $shipping_name   = $cart->buyable->methods->first()->name;

                }
                $this->qty      += $cart->quantity;
                //$this->shipping += round($ship);
                $this->subtotal += round($cart->price * $cart->quantity);
                array_push($data['items'],
                    [
                        'name'  . $index => 'product name : ' . $cart->buyable->name,
                        'price' . $index => 'product price : ' . curr($cart->price),
                        'qty'   . $index => 'product quantity : ' . $cart->quantity,
                    ]);
                array_push($data['shipping'],
                    [
                        'name' => 'shipping_method: ' . $shipping_name, 'price' => 'cost: ' . round($ship),
                        'desc' => 'shipping method: ' . $shipping_name, 'qty' => 1,
                    ]);
                array_push($this->shippings_names, $shipping_name);

            }
        }

        if (session()->get('coupon') !== null) {
            foreach (session()->get('coupon') as $coupon) {
                if ($coupon['is_usd'] === 1) {
                    $this->coupons += $coupon['reward'];
                } else {
                    $this->coupons += ($this->subtotal + $this->shipping) * $coupon['reward'] / 100;
                }
            }
        }
        $data['total'] = round($this->subtotal + $this->shipping - $this->coupons);
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
        $this->store_orders($validate);
        try {
            if (session()->get('items') !== null) {
                foreach (session()->get('items') as $cart) {
                    \Cart::remove($cart['shipping']);
                }
            } else {
                foreach (\Cart::content() as $cart) {
                    \Cart::remove($cart->id);
                }
            }
            session()->forget('items');
        } catch (\Exeption $e) {

        }
        session()->forget('coupon');
        return redirect()->route('success_page');

    }

    public function store_orders($validate = null)
    {


        (session()->get('data') !== null)?$validate = session()->get('data')[0]:$validate;
        (session()->get('shippings_names') !== null)?$this->shippings_names = session()->get('shippings_names')[0]:$this->shippings_names;

        if ($validate['payment_method'] === 'paypal') {
            $this->shipping = 0;
            $this->subtotal = 0;
            $this->coupons  = 0;
            if (session()->get('items') !== null) {
                foreach (session()->get('items') as $cart) {
                    $cc              = \Cart::content()->find($cart['item']);

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
                foreach (\Cart::content() as $cart) {
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
        }
        if (session()->get('coupon') !== null) {
            foreach (session()->get('coupon') as $coupon) {
                if ($coupon['is_usd'] === 1) {
                    $this->coupons += $coupon['reward'];
                } else {
                    $this->coupons += ($this->subtotal + $this->shipping) * $coupon['reward'] / 100;
                }
            }
        }
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
                $cc = \Cart::content()->find($cart['item']);

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
            foreach (\Cart::content() as $cart) {

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
       // event(new NewOrder(trans('admin.new_Order')));

        session()->forget('order');
        session()->forget('coupon');
        return session()->push('order', $order);
    }

}
