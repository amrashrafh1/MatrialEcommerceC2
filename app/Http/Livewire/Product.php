<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Events\cartEvent;
use App\Product as Pro;

class Product extends Component
{

    public $product;


    public function mount ($product) {
        $this->product = $product;

    }
    public function render()
    {
        return view('livewire.product');
    }



    public function addCart($id) {

        $product = Pro::find($id);
        if($product) {
            \Cart::add($product,1);
            $this->emit('cartAdded');
        }
    }
}
