<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\Resources\PaymentsResource;
use App\Payment;
use App\Http\Controllers\Api\ApiResponse;

class PaymentController extends Controller
{
    use ApiResponse;

    public function index() {

        return $this->sendResult('paginate 10 payments',
        PaymentsResource::collection(Payment::paginate(10)));
    }


    public function show($id) {

        $Payment = Payment::where('id',$id)->first();
        if($Payment) {
            return $this->sendResult('show payments',new PaymentsResource($Payment));
        }
        return $this->sendResult('payment not found',null, 'payment not found',false);
    }
}
