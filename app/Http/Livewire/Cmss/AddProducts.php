<?php

namespace App\Http\Livewire\Cmss;

use Livewire\Component;
use Livewire\WithPagination;
use App\Product;
use App\CMS;
class AddProducts extends Component
{
    use WithPagination;

    public $cms;
    public $search    = '';
    public $searchHas = '';
    public $result    = [];

    public function mount($cms) {
        $this->cms = $cms;
    }
    public function render()
    {
        $result = Product::paginate(20);
        return view('livewire.cmss.add-products',['products' =>
        Product::disableCache()->where('name', 'like', '%'.$this->search.'%')->paginate(20),
        'accessories' => $this->cms->products()->disableCache()->where('name', 'like', '%'.$this->searchHas.'%')->paginate(20)]);
    }

    public function updatingSearch(): void
    {
        $this->gotoPage(1);
    }



    public function add_products($id) {
        $this->cms->products()->attach($id);
    }
    public function remove_products($id) {
        $this->cms->products()->detach($id);
    }


    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
