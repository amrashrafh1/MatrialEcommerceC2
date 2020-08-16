<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
use App\Category;
use App\Events\cartEvent;

class TrendingNow extends Component
{
    public function render()
    {
        // get top 20 trending now
        $products = Product::where('section','trending_now')
        ->select('id','slug','image','product_type','name','sale_price')->inRandomOrder()->take(20)->get();

        // get random trending now categories
        $categories = Category::inRandomOrder()->select('name', 'id', 'slug')
        ->whereHas('products', function ($q) {
            $q->where('section','trending_now');
        })
        ->with(['products'=> function ($q) {
            $q->where('section','trending_now');
        }])->take(4)->get();
        return view('livewire.trending-now',['products' => $products, 'categories' => $categories]);
    }

    public function addCart($id) {

        $product = Product::find($id);
        if($product) {
            \Cart::add($product,1);
            $this->emit('cartAdded');
        }
    }
}
