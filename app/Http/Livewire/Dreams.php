<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
class Dreams extends Component
{
    public function render()
    {

        $products = Product::where('section','make_dreams_your_reality')
        ->select('id','slug','product_type','name','sale_price')->orderBy('id','desc')->take(20)->get();

        return view('livewire.dreams', ['products' => $products]);
    }

    public function addCart($id) {

        $product = Product::find($id);
        if($product) {
            \Cart::add($product,1);
            //event(new cartEvent('fire'));
            $this->emit('cartAdded');
        }
    }
}
