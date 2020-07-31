<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
use App\Category;
use App\Events\cartEvent;

class NewArrivals extends Component
{
    protected $casts;

    public function render()
    {
        $products = Product::IsApproved()->where('section','hot_new_arrivals')
        ->select('id','slug','product_type','image','name','sale_price')->latest()->take(20)->get();

       // dd($products);

        $categories = Category::inRandomOrder()->select('name', 'id', 'slug')
        ->whereHas('products', function ($query) {
            $query->where('visible', 'visible')->where('approved', 1);
        })->take(4)->get();
        return view('livewire.new-arrivals',['products' => $products, 'categories' => $categories]);
    }


    public function addCart($id) {

        $product = Product::find($id);
        if($product) {
            \Cart::add($product,1);
            //event(new cartEvent('fire'));
            $this->emit('cartAdded');
        }
    }

}
