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
    public $owner;

    public function mount($type,$id, $owner = null) {
        $this->productType = $type;
        $this->owner       = $owner;
        $product           = Product::where('id', $id)->first();

        $this->product_id     = $id;
        if($product) {

            $this->search = $product->name;

        }
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
        return view('livewire.admin.discount.edit-product-id', ['products' =>$products]);
    }


    public function updatingSearch(): void
    {
        $this->gotoPage(1);
    }
}
