<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
use Auth;
class HandPicked extends Component
{
    public function render()
    {
        $handpicked = Product::IsApproved()
        ->select('id','slug','name','sale_price','image')
        ->inRandomOrder()->take(36)->get();

        $stores = (Auth::check())?auth()->user()->followee()
        ->with(['products'=> function ($query) {
            $query->where('visible', 'visible')->where('approved', 1)->where('owner', 'for_seller')
            ->select('id','slug','product_type','user_id','owner','image','name','sale_price')->orderBy('id', 'desc')->take(20);
        }])
        ->inRandomOrder()->take(4)->get():[];

        return view('livewire.hand-picked', ['handpicked' => $handpicked, 'stores' =>$stores]);
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
