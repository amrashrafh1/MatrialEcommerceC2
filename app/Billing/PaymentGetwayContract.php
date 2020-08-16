<?php

namespace App\Billing;

interface PaymentGetwayContract
{

    public function charge($validate = null,$token = null);

    public function discount();
}
