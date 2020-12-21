<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Attribute_Family;

class Variations extends Component
{

    public $product;
    public $variations = [];
    public $families   = [];

    public function mount($rows) {
        $this->product = $rows;
    }

    public function render()
    {
        $id               = $this->product->id;
        $attributes       = $this->product->attributes->pluck('id');
        $this->families   = Attribute_Family::whereHas('attributes', function ($query) use ($id, $attributes) {
            $query->whereIn('id', $attributes)->whereHas('products', function ($q) use ($id) {
                $q->where('id', $id);
            });
        })->with(['attributes' => function ($query) use ($id, $attributes) {
            $query->whereIn('id', $attributes)->whereHas('products', function ($q) use ($id) {
                $q->where('id', $id);
            });
        }])->get();
        return view('livewire.variations', ['product' => $this->product,
        'family' => $this->families
        ,'variations' => $this->variations]);
    }


    public function infinity() {
        $id               = $this->product->id;
        $attributes       = $this->product->attributes->pluck('id');
        $families         = Attribute_Family::whereHas('attributes', function ($query) use ($id, $attributes) {
            $query->whereIn('id', $attributes)->whereHas('products', function ($q) use ($id) {
                $q->where('id', $id);
            });
        })->with(['attributes' => function ($query) use ($id, $attributes) {
            $query->whereIn('id', $attributes)->whereHas('products', function ($q) use ($id) {
                $q->where('id', $id);
            });
        }])->get();
        $arrays = [];
        foreach($families as $index => $family) {
            array_push($arrays, $family->attributes->pluck('id')->toArray());
        }
        $this->variations = $this->build($arrays);
        return $this->variations;
    }

    public function build($set)
    {
        if (!$set) {
            return array(array());
        }

        $subset = array_shift($set);
        $cartesianSubset = self::build($set);

        $result = array();
        foreach ($subset as $value) {
            foreach ($cartesianSubset as $p) {
                array_unshift($p, $value);
                $result[] = $p;
            }
        }

        return $result;
    }

    public function addRaw() {
        array_push($this->variations, $this->families->pluck('name')->toArray());
    }

    public function deleteRaw($index) {
        unset($this->variations[$index]);
        return;
    }
}
