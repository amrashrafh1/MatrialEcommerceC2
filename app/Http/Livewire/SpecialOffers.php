<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Category;
use App\Discount;
use App\Events\cartEvent;
use Auth;

class SpecialOffers extends Component
{
    public function render()
    {
        $categories = Category::where('status', 1)->select('name', 'id', 'slug')
        ->whereHas('products', function ($q) {
            $q->whereHas('discount', function ($s) {
                $s->where('start_at', '<=',\Carbon\Carbon::now())
                ->where('expire_at', '>',\Carbon\Carbon::now())
                ->where('daily', 'special_offers');
            });
        })
        ->with(['products'=> function ($q) {
            $q->whereHas('discount', function ($s) {
                $s->where('start_at', '<=',\Carbon\Carbon::now())
                ->where('expire_at', '>',\Carbon\Carbon::now())
                ->where('daily', 'special_offers');
            });
        }])->take(8)->get();
        $compare = (session()->get('compare'))?session()->get('compare'):[];
        $wishlist_product_id = (Auth::check())?auth()->user()->wishlists()->disableCache()->pluck('product_id'):[];

        return view('livewire.special-offers', ['categories' => $categories, 'compare' => $compare
        ,'wishlist_product_id' => $wishlist_product_id]);
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
            event(new cartEvent('fire'));
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
