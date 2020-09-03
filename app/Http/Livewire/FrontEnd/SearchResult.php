<?php

namespace App\Http\Livewire\FrontEnd;

use App\Category;
use App\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SearchResult extends Component
{
    use WithPagination;

    public $cat_id;
    public $search = '';
    public $categories;
    public $products = [];

    public function mount($categories)
    {
        $this->categories = $categories;
    }
    public function render()
    {
        //dd($this->search);
        $products = [];
        if (!empty($this->search)) {
            // Validation for $this->search & $this->category_id
            $data = $this->validate([
                'search' => 'required|string',
                'cat_id' => 'sometimes|nullable|exists:categories,id',
            ], [], [
                'search' => trans('user.search'),
                'cat_id' => trans('user.category'),
            ]);
            if (!empty($data['cat_id'])) {
                $search = $data['search'];
                // Find category by id
                $categories = Category::where('id', $data['cat_id'])->first();

                $id = [];
                // get category children
                $id = $categories->categories->pluck('id')->toArray();

                array_push($id, $categories->id);

                // get all products where category_id in $id
                $products = Product::whereIn('category_id', $id)->where('visible', 'visible')->where('name', 'like', '%' . $data['search'] . '%')
                    ->orWhere('description', 'like', '%' . $data['search'] . '%')->disableCache()->paginate(10);
            } else {
                $products = Product::where('visible', 'visible')->where('name', 'like', '%' . $data['search'] . '%')
                    ->orWhere('description', 'like', '%' . $data['search'] . '%')->disableCache()->paginate(10);
            }
        }

        return view('livewire.front-end.search-result', ['categories' => $this->categories, 'result' => $products]);
    }

    public function search()
    {

    }
    public function updatingSearch(): void
    {
        $this->gotoPage(1);
    }
}
