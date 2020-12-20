<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
class CheckoutController extends Controller
{
    public function __invoke(Request $request) {
        if(blank(carts_content())) {
            return redirect()->route('home');
        };

        $payment = '';
        if($request->payment === 'stripe') {
            $payment = 'stripe';
        } elseif($request->payment === 'paypal') {
            $payment = 'paypal';
        }
        return view('FrontEnd.checkout', ['payment' => $payment]);
    }

}
