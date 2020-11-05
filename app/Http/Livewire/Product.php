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



    public function addCart($id)
    {
        if (is_numeric($id) && $id) {
            $product = Product::find($id);
            if ($product) {
                if($product->visible == 'visible' && $product->approved == 1) {
                    \Cart::add($product, 1);
                    $this->emit('cartAdded');
                }
            }
        }
    }
}
