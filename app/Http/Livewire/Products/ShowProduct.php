<?php

namespace App\Http\Livewire\Products;

use App\Product;
use Auth;
use Livewire\Component;

class ShowProduct extends Component
{
    public $product;
    public $total                 = 0;
    public $accessories           = [];
    public $prices                = [];
    public $followers             = 0;
    public $isFollow              = false;
    public $isWishlist            = false;
    public $store_followers_count = 0;

    public function mount($product)
    {

        $this->product = $product;
        if ($product->owner == 'for_seller') {

            if (Auth::check()) {
                if (!auth()->user()->followee()->pluck('id')->contains((isset($this->product->store)) ? $this->product->store->id : [])) {
                    $this->isFollow = false;
                } else {
                    $this->isFollow = true;
                }
                if (auth()->user()->wishlists()->disableCache()->pluck('id')->contains($this->product->id)) {
                    $this->isWishlist = true;
                } else {
                    $this->isWishlist = false;
                }
            }
        $this->store_followers_count = $this->product->store->followers->count();

        }
    }

    public function render()
    {
        $tradmark                    = $this->product->tradmark;
        return view('livewire.products.show-product', ['tradmark' => $tradmark,
        'store_followers_count' => $this->store_followers_count]);
    }

    public function follow()
    {
        if (Auth::check()) {
            if (!auth()->user()->followee()->pluck('id')->contains($this->product->store->id)) {
                $this->product->store->followers()->attach(auth()->user()->id);
                $this->isFollow = true;
                $this->store_followers_count = $this->product->store->followers->count() + 1;
            } else {
                $this->product->store->followers()->detach(auth()->user()->id);
                $this->isFollow = false;
                $this->store_followers_count = $this->product->store->followers->count() - 1;
            }
        }
    }

    public function wishlists()
    {
        if (Auth::check()) {
            if (auth()->user()->wishlists()->disableCache()->pluck('product_id')->contains($this->product->id)) {
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
    /* public function get_variation($slug, $id) {

        $product    = Product::where('slug', $slug)->IsApproved()->first();
        $variations = $product->variation()->where('visible', 'visible')
        ->whereHas('attributes', function($q) use ($id) {
            $q->where('id', $id);
        })->get();
        if($variations->count() > 0) {
        $productAttributes = [];
        foreach($variations as $var) {
            foreach($var->attributes as $attr) {
                array_push($productAttributes, $attr);
            }
        }
        return $productAttributes;
    } else {

        return $productAttributes = ['0','0'];
    }

    } */

    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
