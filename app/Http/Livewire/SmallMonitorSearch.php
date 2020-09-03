<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Category;
use App\Product;
class SmallMonitorSearch extends Component
{
    use WithPagination;

    public $categoty_id;
    public $smallSearch = '';
    public $categories;
    public $smallProducts = [];

    public function mount($categories)
    {
        $this->categories = $categories;
    }
    public function render()
    {
        //dd($this->search);
        $smallProducts = [];
        if (!empty($this->smallSearch)) {
            // Validation for $this->search & $this->category_id
            $data = $this->validate([
                'smallSearch' => 'required|string',
                //'categoty_id' => 'sometimes|nullable|exists:categories,id',
            ], [], [
                'smallSearch' => trans('user.search'),
               // 'categoty_id' => trans('user.category'),
            ]);
            /* if (!empty($data['categoty_id'])) {
                $search = $data['smallSearch'];
                // Find category by id
                $categories = Category::where('id', $data['categoty_id'])->first();

                $id = [];
                // get category children
                $id = $categories->children->pluck('id')->toArray();

                array_push($id, $categories->id);

                // get all smallProducts where category_id in $id
                $smallProducts = Product::whereIn('category_id', $id)->where('visible', 'visible')->where('name', 'like', '%' . $data['search'] . '%')
                    ->orWhere('description', 'like', '%' . $data['search'] . '%')->disableCache()->paginate(10);
            } else { */
                $smallProducts = Product::where('visible', 'visible')->where('name', 'like', '%' . $data['smallSearch'] . '%')
                    ->orWhere('description', 'like', '%' . $data['smallSearch'] . '%')->disableCache()->paginate(10);
            /* } */
        }

        return view('livewire.small-monitor-search', ['categories' => $this->categories, 'results' => $smallProducts]);
    }

    public function search()
    {

    }
    public function updatingSearch(): void
    {
        $this->gotoPage(1);
    }
}
