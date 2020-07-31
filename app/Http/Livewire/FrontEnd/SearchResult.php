<?php

namespace App\Http\Livewire\FrontEnd;

use Livewire\Component;
use App\Product;
use App\Category;
use Livewire\WithPagination;

class SearchResult extends Component
{
    use WithPagination;

    public $product_cat;
    public $search = '';
    public $categories;
    public $products = [];

    public function mount($categories) {
        $this->categories = $categories;
    }
    public function render()
    {
        $products = [];
        if(!empty($this->search)) {

            $data = $this->validate([
                'search'      => 'required|string',
                'product_cat' => 'sometimes|nullable|exists:categories,id',
            ],[],[
                'search'      => trans('user.search'),
                'product_cat' => trans('user.category')
            ]);
            if(!empty($data['product_cat'])) {
            $search     = $data['search'];
            $categories = Category::where('id', $data['product_cat'])->first();
            $id         = [];
            $id         = $categories->children->pluck('id')->toArray();
            array_push($id, $categories->id);
            $products = Product::whereIn('category_id', $id)->where('visible', 'visible')->where('name', 'like', '%' . $data['search'] . '%')
            ->orWhere('description', 'like', '%' . $data['search'] . '%')->disableCache()->paginate(10);
            } else {
                $products = Product::where('visible', 'visible')->where('name', 'like', '%' . $data['search'] . '%')
                ->orWhere('description', 'like', '%' . $data['search'] . '%')->disableCache()->paginate(10);
            }
        }
        return view('livewire.front-end.search-result',['categories' => $this->categories,'products' => $products]);
    }


    public function search() {

    }

}
