<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Category;
use App\Discount;
use App\Events\cartEvent;

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

        return view('livewire.special-offers', ['categories' => $categories]);
    }



    public function addCart($id) {

        $product = Product::find($id);
        if($product) {
            \Cart::add($product,1);
            event(new cartEvent('fire'));
        }
    }
}
