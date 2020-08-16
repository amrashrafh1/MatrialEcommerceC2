<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\OrderTraking;
use Mail;
use App\Order;
class TrackYourOrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('FrontEnd.track-your-order');
    }


    public function send(Request $request)
    {
        $data = $this->validate(request(), [
            'orderid'     => 'required|string|exists:orders,order_id',
            'order_email' => 'required|email|exists:orders,billing_email',
        ], [], [
            'orderid'     => trans('user.Order_Id'),
            'order_email' => trans('user.billing_email'),
        ]);
        $order = Order::where('order_id', $data['orderid'])->where('billing_email', $data['order_email'])->first();
        if($order) {
            Mail::to($data['order_email'])->send(new OrderTraking($order));
        }
        return redirect()->back();

    }
}
