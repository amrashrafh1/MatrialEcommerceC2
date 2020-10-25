<?php

namespace App\Http\Livewire;

use App\Discount;
use App\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Auth;

class Deals extends Component
{
    use WithPagination;

    public function render()
    {


        $discountProducts = Discount::discountAvailable()
        ->where('daily', 'daily_deals')
        ->whereHas('product' , function ($query) {
            $query->where('visible', 'visible')->where('approved', 1)
            ->select('id','slug','product_type','image','name','sale_price');
        })->paginate(12);
        
        $random = Discount::discountAvailable()
            ->where('daily', 'daily_deals')
            ->whereHas('product' , function ($query) {
                $query->where('visible', 'visible')->where('approved', 1)
                ->select('id','slug','product_type','image','name','sale_price');
            })->first();

        return view('livewire.deals', ['discountProducts' => $discountProducts, 'random' => $random,
        ]);
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
