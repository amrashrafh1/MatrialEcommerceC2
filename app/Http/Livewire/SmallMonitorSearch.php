<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Category;
use App\Product;
class SmallMonitorSearch extends Component
{
    use WithPagination;

    public $smallSearch = '';
    public $categories;

    public function mount($categories)
    {
        $this->categories = $categories;
    }
    public function render()
    {
        $lang = session('locale');
        $tags = [];
        if (!empty($this->smallSearch)) {
            // Validation for $this->search & $this->category_id
            $data = $this->validate([
                'smallSearch' => 'required|string',
            ], [], [
                'smallSearch' => trans('user.search'),
            ]);
            $tags = \Spatie\Tags\Tag::Containing($data['smallSearch'], $lang)->paginate(10);
        }

        return view('livewire.small-monitor-search', ['categories' => $this->categories, 'results' => $tags]);
    }

    public function search()
    {

    }
    public function updatingSearch(): void
    {
        $this->gotoPage(1);
    }

    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
