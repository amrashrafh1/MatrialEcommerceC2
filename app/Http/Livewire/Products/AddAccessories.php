<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Product;
class AddAccessories extends Component
{
    use WithPagination;

    public $product;
    public $search = '';
    public $searchHas = '';
    public $result = [];

    public function mount($product) {
        $this->product = $product;
    }
    public function render()
    {
        $result = Product::where('id','!=',$this->product->id)->disableCache()->paginate(20);
        return view('livewire.products.add-accessories',['products' =>
        Product::where('id','!=',$this->product->id)->where('name', 'like', '%'.$this->search.'%')->disableCache()->paginate(20),
        'accessories' =>$this->product->accessories()->where('name', 'like', '%'.$this->searchHas.'%')->disableCache()->paginate(20)]);
    }

    public function updatingSearch(): void
    {
        $this->gotoPage(1);
    }



    public function add_accessories($id) {
        $this->product->accessories()->attach($id);
    }
    public function remove_accessories($id) {
        $this->product->accessories()->detach($id);
    }

    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
