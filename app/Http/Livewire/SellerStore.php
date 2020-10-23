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
    public $seller;
    public $followers = 0;
    public $isFollow = false;

    public function mount($seller) {
        $this->seller = $seller;
        if(Auth::check()) {
            if(!auth()->user()->followee()->pluck('id')->contains($seller->id)) {
                $this->isFollow = false;
            } else {
                $this->isFollow = true;
            }
        }
    }
    public function render()
    {
        $products = $this->seller->products()->isApproved()->disableCache()->paginate(20);
        return view('livewire.seller-store', ['seller' => $this->seller, 'products' => $products]);
    }


    public function follow() {
        if(Auth::check()) {
            if(!auth()->user()->followee()->pluck('id')->contains($this->seller->id)) {
                $this->seller->followers()->attach(auth()->user()->id);
                $this->isFollow = true;
            } else {
                $this->seller->followers()->detach(auth()->user()->id);
                $this->isFollow = false;
            }
        }
    }

    public function addCart($id)
    {
        if (is_numeric($id) && $id) {
            $product = Product::find($id);
            if ($product) {
                \Cart::add($product, 1);
                $this->emit('cartAdded');
            }
        }
    }
    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
