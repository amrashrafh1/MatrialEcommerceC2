<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SmallMonitorCart extends Component
{
    protected  $listeners = ['cartAdded' => 'cartEvent'];


    public function cartEvent() {

    }
    public function render()
    {
        return view('livewire.small-monitor-cart');
    }
}
