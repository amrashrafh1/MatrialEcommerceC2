<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Category;
use App\Discount;
use App\Product;
use App\Events\cartEvent;
use Auth;

class SpecialOffers extends Component
{
    public function render()
    {
        $categories = Category::where('status', 1)->select('name', 'id', 'slug')
        ->whereHas('products', function ($q) {
            $q->where('visible', 'visible')->where('approved', 1)
            ->whereHas('discount', function ($d) {
                $d->where([
                ['condition', 'percentage_of_product_price'],['daily', 'special_offers'],
                ['start_at', '<=', \Carbon\Carbon::now()],
                ['expire_at', '>', \Carbon\Carbon::now()]])

                ->orWhere([

                ['condition', 'fixed_amount'],['daily', 'special_offers'],
                ['start_at', '<=', \Carbon\Carbon::now()],
                ['expire_at', '>', \Carbon\Carbon::now()]])->take(9);
            });
        })
        ->with(['products'=> function ($q) {
            $q->where('visible', 'visible')->where('approved', 1)

            ->whereHas('discount', function ($d) {
                $d->where([
                ['condition', 'percentage_of_product_price'],['daily', 'special_offers'],
                ['start_at', '<=', \Carbon\Carbon::now()],
                 ['expire_at', '>', \Carbon\Carbon::now()]])

                ->orWhere([

                ['condition', 'fixed_amount'],['daily', 'special_offers'],
                ['start_at', '<=', \Carbon\Carbon::now()],
                ['expire_at', '>', \Carbon\Carbon::now()]])->take(9);
            });
        }])
        ->take(7)->get();


        return view('livewire.special-offers', ['categories' => $categories]);
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

    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
