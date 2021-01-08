<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Category;
use App\Product;
use App\SellerInfo;
class SmallMonitorSearch extends Component
{
    use WithPagination;

    public $smallSearch = '';
    public $slug        = null;

    public function mount($slug = null)
    {
        $this->slug = $slug;
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
            if(!blank($this->slug)) {
                $store = SellerInfo::where('slug', $this->slug)->with(['products' => function ($query) {
                    $query->where('visible', 'visible')->where('approved',1);
                }, 'discount'])->first();
                $tags = $store->products()->where('name', 'LIKE', '%'.$data['smallSearch']. '%')
                ->with('discount')->paginate(10);
            } else {
            $tags = \Spatie\Tags\Tag::Containing($data['smallSearch'], $lang)->paginate(10);
            }
        }

        return view('livewire.small-monitor-search', ['results' => $tags]);
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
