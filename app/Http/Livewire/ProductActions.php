<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Attribute_Family;
use App\Variation;
use App\Attribute;
use Illuminate\Http\Request;
use App\Events\cartEvent;
class ProductActions extends Component
{
    public $product;
    public $productAttributes = [];
    public $attribute;


    public function mount($product) {
        $this->product = $product;
    }

    public function render()
    {
        $attributes = $this->product->attributes;
        $family     = [];

        /* loop attributes and get parent who has this attributes [not all family] */

        foreach($attributes as $attr) {
            $id  = $attr->id;
            $ff  = Attribute_Family::whereHas('attributes', function ($q) use ($id) {
                $q->where('id', $id);
            })->first();

            if(!in_array($ff, $family)) {
                array_push($family,$ff);
            }
        }
        return view('livewire.product-actions', ['family' => $family]);
    }

    public function get_variation() {


        $id = $this->attribute;
        $variations = Variation::where('visible', 'visible')->where('product_id', $this->product->id)
        ->whereHas('attributes', function($q) use ($id) {
            $q->where('id', $id);
        })->get();
        if($variations->count() > 0) {
        $this->productAttributes = [];
        foreach($variations as $var) {
            foreach($var->attributes as $attr) {
                array_push($this->productAttributes, $attr);
            }
        }
    } else {

        $this->productAttributes = ['0','0'];
    }

    }

    public function add_cart($submit) {
        //$this->options = $attrs;
    $opts = [];
    dd($submit['attributes[]']);
        $data = $this->validate([
            'quantity'  => 'required|numeric',
            'options'   => 'required|array',
        ], [],[
            'quantity' => trans('admin.quantity'),
            'options' => trans('admin.options'),
        ]);
        $attributes = Attribute::whereIn('id', $data['options'])->get();
        foreach($attributes as $attr) {
            $family = Attribute_Family::where('id', $attr->family_id)->first();
            if($family) {
                array_push($opts, [$family->name => $attr->name]);
            }
        }
        \Cart::add($this->product,$data['quantity'], $opts);
        $this->emit('cartAdded');

    }


    public function compare() {
        if(session()->get('compare') !== null) {
            if(!in_array($this->product->id,session()->get('compare'))) {
                $this->emit('cartAdded');
                return  session()->push('compare', $this->product->id);
            } else {
                return ;
            }
        } else {
            $this->emit('cartAdded');
            return  session()->push('compare', $this->product->id);
        }

    }

}
