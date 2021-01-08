<?php

namespace App\Http\Livewire\FrontEnd;

use App\Category;
use App\Product;
use App\SellerInfo;
use Livewire\Component;
use Livewire\WithPagination;
use \Spatie\Tags\Tag;
use Spatie\Searchable\Search;

class SearchResult extends Component
{
    use WithPagination;

    public $search = '';
    public $slug   = null;

    public function mount($slug = null) {
        $this->slug = $slug;
    }

    public function render()
    {
        $tags = [];
        $lang = session('locale');
        if (!empty($this->search)) {
            // Validation for $this->search
            $data = $this->validate([
                'search' => 'required|string',
            ], [], [
                'search' => trans('user.search'),
            ]);
            if(!blank($this->slug)) {
                $store = SellerInfo::where('slug', $this->slug)->with(['products' => function ($query) {
                    $query->where('visible', 'visible')->where('approved',1);
                }, 'products.discount'])->first();
                $tags = $store->products()->where('name', 'LIKE', '%'.$data['search']. '%')->with('discount')->paginate(10);
            } else {
                $tags = \Spatie\Tags\Tag::Containing($data['search'], $lang)->paginate(10);
            }
        }

        return view('livewire.front-end.search-result', ['tags' => $tags]);
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
