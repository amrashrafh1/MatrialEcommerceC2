<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class SmallMonitorCart extends Component
{
    protected  $listeners = ['cartAdded' => 'cartEvent'];

    public $carts = [];
    public function cartEvent() {

    }
    public function render()
    {
        $this->carts = Cart::content();

        return view('livewire.small-monitor-cart');
    }
}
