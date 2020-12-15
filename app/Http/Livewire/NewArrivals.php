<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
use App\Category;
use App\Events\cartEvent;
use Auth;

class NewArrivals extends Component
{

    public function render()
    {
        $products = Product::IsApproved()->where('section','hot_new_arrivals')
        ->select('id','slug','product_type','image','name','sale_price')
        ->with(['discount', 'methods'])->latest()->take(20)->get();


        $categories = Category::where('status',1)->where('parent_id', NULL)->inRandomOrder()->select('name', 'id', 'slug')
        ->whereHas('products', function ($q) {
            $q->where('visible', 'visible')->where('approved', 1)
            ->where('section','hot_new_arrivals')
            //->select('id','slug','product_type','visible','approved','section','image','name','sale_price')
            ->take(20);
        })
        ->with(['products'=> function ($q) {
            $q->where('visible', 'visible')->where('approved', 1)
            ->where('section','hot_new_arrivals')
            //->select('id','slug','product_type','visible','approved','section','image','name','sale_price')
            ->take(20);
        }])
        ->take(4)->get();

        return view('livewire.new-arrivals',['products' => $products,
         'categories' => $categories]);
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

}
