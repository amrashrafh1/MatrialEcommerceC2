<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Product;
use Auth;
class ShowProduct extends Component
{
    public $product;
    public $total       = 0;
    public $accessories = [];
    public $prices      = [];
    public $followers   = 0;
    public $isFollow    = false;
    public $isWishlist  = false;

    public function mount($product) {

        $this->product = $product;
        if($product->owner  == 'for_seller') {


        if(Auth::check()) {

            if(!auth()->user()->followee()->pluck('id')->contains((isset($this->product->store))?$this->product->store->id:[])) {
                $this->isFollow = false;
            } else {
                $this->isFollow = true;
            }
            if(auth()->user()->wishlists()->disableCache()->pluck('id')->contains($this->product->id)) {
                $this->isWishlist = true;
            } else {
                $this->isWishlist = false;
            }
        }
    }
    }

    public function render()
    {
        $this->totals = 0;
        $this->total = 0;

        foreach($this->accessories as $tota) {
            if(isset($this->prices[$tota])) {
                $product = Product::where('id', $tota)->first();
                if($product) {
                    $this->total += $product->calc_price();
                }
            }
        }
        return view('livewire.products.show-product');
    }

    public function follow() {
        if(Auth::check()) {
            if(!auth()->user()->followee()->pluck('id')->contains($this->product->store->id)) {
                $this->product->store->followers()->attach(auth()->user()->id);
                $this->isFollow = true;
            } else {
                $this->product->store->followers()->detach(auth()->user()->id);
                $this->isFollow = false;
            }
        }
    }

    public function wishlists() {
        if(Auth::check()) {
            if(auth()->user()->wishlists()->disableCache()->pluck('product_id')->contains($this->product->id)) {
                auth()->user()->wishlists()->disableCache()->detach($this->product->id);
                $this->emit('wishlistAdded');

                $this->isWishlist = false;

            } else {
                auth()->user()->wishlists()->disableCache()->attach($this->product->id);
                $this->emit('wishlistAdded');

                $this->isWishlist = true;

            }
        }
    }

}
