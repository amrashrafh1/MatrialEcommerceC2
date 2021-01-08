<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
class RelatedProduct extends Component
{
    public $product;
    public $related = [];
    public function mount($product = null, $tags = null) {
        if($product) {
            $this->product = $product;
            $this->related = Product::withAllTags($tags->pluck('name'))
            ->where('id', '!=', $this->product->id)
            ->select('id','slug','product_type','image','name','tax','sale_price')
            ->with('discount')->take(20)->get();
        }

    }

    public function render()
    {
        return view('livewire.related-product', ['related' => $this->related]);
    }
}
