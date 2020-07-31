<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StripePayment extends Component
{
    public function render()
    {
        return view('livewire.stripe-payment');
    }
}
