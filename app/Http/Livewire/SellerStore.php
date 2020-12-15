<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\Product;
use App\Events\cartEvent;
use Livewire\WithPagination;

class SellerStore extends Component
{
    use WithPagination;
    public $store;
    public $followers = 0;
    public $isFollow = false;

    public function mount($store) {
        $this->store = $store;
        if(Auth::check()) {
            if(!auth()->user()->followee()->pluck('id')->contains($store->id)) {
                $this->isFollow = false;
            } else {
                $this->isFollow = true;
            }
        }
    }
    public function render()
    {
        $products = $this->store->products()->isApproved()
        ->select('name','approved','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
        ->with('discount', 'ratings', 'methods')->disableCache()->paginate(20);

        return view('livewire.seller-store', ['seller' => $this->store, 'products' => $products]);
    }


    public function follow() {
        if(Auth::check()) {
            if(!auth()->user()->followee()->pluck('id')->contains($this->store->id)) {
                $this->store->followers()->attach(auth()->user()->id);
                $this->isFollow = true;
            } else {
                $this->store->followers()->detach(auth()->user()->id);
                $this->isFollow = false;
            }
        }
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

    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
