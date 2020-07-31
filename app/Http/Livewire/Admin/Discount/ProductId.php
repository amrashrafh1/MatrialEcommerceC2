<?php

namespace App\Http\Livewire\Admin\Discount;

use Livewire\Component;
use Livewire\WithPagination;

class ProductId extends Component
{
    use WithPagination;
    public $search;

    public $productType;

    public function mount($type) {
        $this->productType = $type;
    }
    public function render()
    {
        return view('livewire.admin.discount.product_id', ['products' => \App\Product::where('name','LIKE','%'.$this->search. '%')->disableCache()->paginate(5)]);
    }
}
