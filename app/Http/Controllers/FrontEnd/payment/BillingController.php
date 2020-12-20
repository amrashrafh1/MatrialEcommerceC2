<?php

namespace App\Http\Controllers\FrontEnd\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Billing\PaypalPaymentGetway;
use App\Billing\StripePaymentGetway;
use App\Orders\OrderDetails;

class BillingController extends Controller
{
    public function payment(Request $request, $payment) {
//dd('asdasd');
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

            'payment_method' => 'required|in:paypal,card',
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

            'payment_method'     => trans('user.payment_method'),
            'terms'              => trans('user.terms'),
        ]);

        if ($validate['payment_method'] === 'paypal' && $payment == 'paypal') {
            session()->forget('data');
            session()->push('data', $validate);

            $paymentGetway = new PaypalPaymentGetway();
            return $paymentGetway->charge();

        } elseif($validate['payment_method'] === 'card' && $payment == 'stripe') {
            //dd('asdfasdf');
            $paymentGetway = new StripePaymentGetway();
            return $paymentGetway->charge($validate,$request->stripeToken);
        }
        else {
            return redirect()->route('show_checkout');
        }


    }


    public  function success(Request $request) {
        $paymentGetway = new PaypalPaymentGetway();
        return $paymentGetway->success($request);
    }



    public  function fail_page($message = null) {
        if($message && is_string($message)) {
            return view('FrontEnd.fail_page', ['message' => $message]);
        }
        return view('FrontEnd.fail_page');
    }

    public function cancel()
    {
        return view('FrontEnd.fail_page');
    }
}
