<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Attribute_Family;
use App\Variation;
class EditVariations extends Component
{
    public $product;

    public function mount($rows) {
        $this->product = $rows;
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
        $variations = $this->product->variations;
        return view('livewire.edit-variations', ['product' => $this->product,
        'family' => $family,
        'variations' =>$variations]);
    }


    public function delete_variation($id) {
        $var = Variation::find($id);
        if($var) {
            $var->delete();
            return redirect()->route('product_variations', $this->product->id);
        }
    }
}
