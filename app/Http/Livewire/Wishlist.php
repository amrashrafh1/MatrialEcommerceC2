<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Wishlist extends Component
{
    public $Foo;

    protected  $listeners = ['wishlistAdded' => 'wishlistEvent'];

    public function wishlistEvent()
    {
        $this->Foo = 'updated';
    }

    public function render()
    {
        return view('livewire.wishlist');
    }
}
