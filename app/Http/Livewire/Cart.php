<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Alert;
use App\Product;
class Cart extends Component
{
    public $Foo = 'updating';

    // Special Syntax: ['echo:{channel},{event}' => '{method}']
    protected  $listeners = ['cartAdded' => 'cartEvent'];

    public function cartEvent()
    {
        $this->Foo = 'updated';
    }


    public function render()
    {
        $carts = \Cart::content();
        return view('livewire.cart', ['carts'=>$carts]);
    }


    public function removeCart($id) {

        if(is_numeric($id) && $id) {
            \Cart::remove($id);
        }
    }

}
