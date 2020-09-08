<?php

namespace App\Http\Livewire\FrontEnd;

use App\Category;
use App\Product;
use Livewire\Component;
use Livewire\WithPagination;
use \Spatie\Tags\Tag;
use Spatie\Searchable\Search;

class SearchResult extends Component
{
    use WithPagination;

    public  $search = '';

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
            $tags = \Spatie\Tags\Tag::Containing($data['search'], $lang)->paginate(10);
           //dd($tags_id);
           /* $searchResults = (new Search())
           ->registerModel(Tag::class, 'name')
           ->search($data['search']); */
           //dd($searchResults);
           //$tags    = \Spatie\Tags\Tag::whereIn('id', $tags_id)->paginate(10);
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
