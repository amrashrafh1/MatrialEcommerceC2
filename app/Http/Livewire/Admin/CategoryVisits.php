<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Category;
class CategoryVisits extends Component
{
    use WithPagination;

    public function render()
    {
        $categories = Category::disableCache()->orderByUniqueViews()->paginate(10);
        return view('livewire.admin.category-visits', ['categories' => $categories]);
    }
}
