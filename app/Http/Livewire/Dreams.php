<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
use Auth;

class Dreams extends Component
{
    public function render()
    {

        $products = Product::where('section','make_dreams_your_reality')
        ->select('id','slug','product_type','name','sale_price', 'image')->orderBy('id','desc')->take(20)->get();

        return view('livewire.dreams', ['products' => $products]);
    }



    public function wishlists($id) {
        if(Auth::check()) {
            if(auth()->user()->wishlists()->disableCache()->pluck('product_id')->contains($id)) {
                auth()->user()->wishlists()->disableCache()->detach($id);
                $this->emit('wishlistAdded');
            } else {
                auth()->user()->wishlists()->disableCache()->attach($id);
                $this->emit('wishlistAdded');

            }
        }
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
