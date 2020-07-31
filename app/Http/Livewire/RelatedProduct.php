<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
class RelatedProduct extends Component
{
    public $product;
    public $ralated = [];
    public function mount($product, $tags) {
        $this->product = $product;
        $this->related = Product::withAllTags($tags->pluck('name'))
        ->where('id', '!=', $this->product->id)
        ->select('id','slug','product_type','image','name','sale_price')->take(20)->get();
    }

    public function render()
    {
        return view('livewire.related-product', ['related' => $this->related]);
    }
}
