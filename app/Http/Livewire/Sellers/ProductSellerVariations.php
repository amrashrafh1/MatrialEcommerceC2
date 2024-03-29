<?php

namespace App\Http\Livewire\Sellers;

use Livewire\Component;
use App\Attribute_Family;
class ProductSellerVariations extends Component
{
    public $product;

    public function mount($product) {
        $this->product = $product;
    }

    public function render()
    {
        $attributes = $this->product->attributes;
        $family=[];
        foreach($attributes as $attr) {
            $id = $attr->id;
            $ff = Attribute_Family::whereHas('attributes', function ($q) use ($id) {
                $q->where('id', $id);
            })->first();

            if(!in_array($ff, $family)) {
                array_push($family,$ff);
            }
        }
        return view('livewire.sellers.product-seller-variations', ['product' => $this->product, 'family' => $family]);
    }
}
