<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Events\cartEvent;
use App\Product;
class WishlistsPage extends Component
{
    public function render()
    {
        $wishlists = auth()->user()->wishlists;
        return view('livewire.wishlists-page', ['wishlists' => $wishlists]);
    }

    public function addCart($id) {

        $product = Product::find($id);
        if($product) {
            \Cart::add($product,1);
            $this->emit('cartAdded');
        }
    }
    public function removeWishlists($id) {
        if(in_array($id, auth()->user()->wishlists()->pluck('id')->toArray())) {
            return auth()->user()->wishlists()->detach($id);
            event(new cartEvent(trans('user.Your_wishlists_has_been_saved')));
        }
    }
}
