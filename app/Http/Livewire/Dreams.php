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

        $compare = session()->get('compare');

        return view('livewire.dreams', ['products' => $products, 'compare' => $compare]);
    }

    public function addCart($id) {

        $product = Product::find($id);
        if($product) {
            \Cart::add($product,1);
            $this->emit('cartAdded');
        }
    }


    public function compare($id) {
        if(session()->get('compare') !== null) {
            if(!in_array($id,session()->get('compare'))) {
                $this->emit('compareAdded');
                session()->push('compare', $id);
            } else {
                return ;
            }
        } else {
            $this->emit('compareAdded');
            session()->push('compare', $id);
        }

    }
}
