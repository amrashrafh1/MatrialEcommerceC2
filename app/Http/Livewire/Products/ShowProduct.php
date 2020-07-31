<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Product;
use Auth;
class ShowProduct extends Component
{
    public $product;
    public $total = 0;
    public $accessories = [];
    public $prices = [];
    public $followers = 0;
    public $isFollow = false;
    public $isWishlist = false;
    public function mount($product) {

        $this->product = $product;
        if(Auth::check()) {

            if(!auth()->user()->followee()->pluck('id')->contains($this->product->seller->id)) {
                $this->isFollow = false;
            } else {
                $this->isFollow = true;
            }
            if(!auth()->user()->wishlists()->pluck('id')->contains($this->product->id)) {
                $this->isWishlist = false;
            } else {
                $this->isWishlist = true;
            }
        }
    }

    public function render()
    {
        $this->totals = 0;
        $this->total = 0;

        foreach($this->accessories as $tota) {
            if(isset($this->prices[$tota])) {
                $this->total += $this->prices[$tota];
            }
        }
        return view('livewire.products.show-product');
    }

    public function follow() {
        if(Auth::check()) {
            if(!auth()->user()->followee()->pluck('id')->contains($this->product->seller->id)) {
                $this->product->seller->followers()->attach(auth()->user()->id);
                $this->isFollow = true;
            } else {
                $this->product->seller->followers()->detach(auth()->user()->id);
                $this->isFollow = false;
            }
        }
    }

    public function wishlists() {
        if(Auth::check()) {
            if(!auth()->user()->wishlists()->pluck('id')->contains($this->product->id)) {
                auth()->user()->wishlists()->attach($this->product->id);
                $this->isWishlist = true;
            } else {
                auth()->user()->wishlists()->detach($this->product->id);
                $this->isWishlist = false;
            }
        }
    }

}
