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
        $compare = session()->get('compare');

        return view('livewire.trending-now',['products' => $products, 'categories' => $categories
        ,'compare' => $compare]);
    }

    public function addCart($id) {

        $product = Product::find($id);
        if($product) {
            \Cart::add($product,1);
            $this->emit('cartAdded');
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
