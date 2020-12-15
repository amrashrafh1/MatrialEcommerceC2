<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Shipping_methods;
use App\Category;
class CreateProduct extends Component
{


    public function render()
    {
        $zones      = Shipping_methods::select('name', 'id','zone_id','company_id')->with('zone:id,name')->with('shippingcompany:id,name')->get();
        $categories = Category::disableCache()->orderBy('parent_id')
        ->get()
        ->nest()
        ->setIndent('------')
        ->listsFlattened('name');
        return view('livewire.create-product', ['data' => $zones, 'categories' => $categories]);
    }
}
