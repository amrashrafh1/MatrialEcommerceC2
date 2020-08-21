<?php

namespace App\Http\Livewire;

use App\Discount;
use App\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Deals extends Component
{
    use WithPagination;

    public function render()
    {

        $discountProducts = Discount::where('daily', 'daily_deals')->discountAvailable()

            ->with('product:name,slug,product_type,id,sale_price,image')->paginate(12);

        $random = Discount::where('daily', 'daily_deals')->discountAvailable()
            ->with('product:name,slug,product_type,id,sale_price,image,stock')->first();

        $compare = session()->get('compare');

        return view('livewire.deals', ['discountProducts' => $discountProducts, 'random' => $random,
        'compare' => $compare]);
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
