<?php

namespace App\Http\Livewire\Admin\Discount;

use Livewire\Component;
use Livewire\WithPagination;
use App\Product;
class ProductId extends Component
{
    use WithPagination;
    public $search,$productType,$owner;

    public function mount($type, $owner = null) {
        $this->productType = $type;
        $this->owner       = $owner;

    }
    public function render()
    {
        if($this->owner == 'for_seller') {
            $products = Product::where('name','LIKE','%'.$this->search. '%')
            ->where('owner', 'for_seller')->where('user_id', auth()->user()->id)
            ->disableCache()->paginate(5);
        } else {
            $products = Product::where('name','LIKE','%'.$this->search. '%')->disableCache()->paginate(5);
        }
        return view('livewire.admin.discount.product_id', ['products' => $products]);
    }
}
