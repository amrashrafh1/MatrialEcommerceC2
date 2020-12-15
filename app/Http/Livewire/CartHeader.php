<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Alert;
use Cart;
use App\Product;

class CartHeader extends Component
{
    public $Foo = 'updating';

    protected  $listeners = ['cartAdded' => 'cartEvent'];



    public function cartEvent()
    {
        $this->Foo = 'updated';
    }


    public function render()
    {
        $carts = Cart::content();

        return view('livewire.cart-header', ['carts' => $carts]);
    }


    public function removeCart($id) {

        if(is_numeric($id) && $id) {
            Cart::remove($id);
        }
    }

}
