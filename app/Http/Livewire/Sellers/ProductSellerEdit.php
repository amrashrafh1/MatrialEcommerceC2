<?php

namespace App\Http\Livewire\Sellers;

use Livewire\Component;
use App\Product;
use App\Files;
use App\Category;
use App\Shipping_methods;
class ProductSellerEdit extends Component
{
    public $rows;

    public function mount($product)
    {
        $this->rows = $product;
    }

    public function render()
    {
        $zones      = Shipping_methods::select('name', 'id','zone_id','company_id')->with('zone:id,name')->with('shippingcompany:id,name')->get();
        $categories = Category::disableCache()->orderBy('parent_id')
        ->get()
        ->nest()
        ->setIndent('------')
        ->listsFlattened('name');
        return view('livewire.sellers.product-seller-edit', ['data' => $zones]);
    }

    public function removeImage($id) {
        $file = Files::find($id);
        if($file) {
            \Storage::delete($file->file);
            $file->delete();
        }
    }
}
