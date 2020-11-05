<?php

namespace App\Http\Livewire\Sellers;

use Livewire\Component;
use Livewire\WithPagination;
use App\Product;
class ProductSellerAccessories extends Component
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

        return view('livewire.sellers.product-seller-accessories',['products' =>
        Product::where('owner', 'for_seller')
        ->where('user_id', auth()->user()->id)
        ->where('name', 'like', '%'.$this->search.'%')
        ->where('id','!=',$this->product->id)->disableCache()->paginate(20),
        'accessories' =>$this->product->accessories()
        ->disableCache()->where('name', 'like', '%'.$this->searchHas.'%')->paginate(20)]);
    }

    public function updatingSearch(): void
    {
        $this->gotoPage(1);
    }



    public function add_accessories($slug) {
        $rows = Product::where('slug',$slug)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
        if($rows) {
            $this->product->accessories()->attach($rows->id);
        }
    }
    public function remove_accessories($slug) {
        $rows = Product::where('slug',$slug)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
        if($rows) {
            $this->product->accessories()->detach($rows->id);
        }
    }

    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
