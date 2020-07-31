<?php

namespace App\Http\Livewire\Admin\Discount;

use Livewire\Component;
use Livewire\WithPagination;
use App\Product;
class EditProductId extends Component
{
    use WithPagination;

    public $search;
    public $productType;
    public $product_id;

    public function mount($type,$id) {
        $this->productType = $type;
        $product = Product::where('id', $id)->first();

        $this->product_id     = $product->id;
        if($product) {

            $this->search = $product->name;

        }
    }
    public function render()
    {
        return view('livewire.admin.discount.edit-product-id', ['products' => \App\Product::where('name','LIKE','%'.$this->search. '%')->disableCache()->paginate(5)]);
    }


    public function updatingSearch(): void
    {
        $this->gotoPage(1);
    }
}
