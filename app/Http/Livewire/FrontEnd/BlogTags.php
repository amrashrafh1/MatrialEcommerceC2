<?php

namespace App\Http\Livewire\FrontEnd;

use Livewire\Component;
use App\Post;
use Auth;

class BlogTags extends Component
{
    public $tag;
    public $tags       = [];
    public $PerPage    = 20;
    public $PageNumber = 1;

    public function mount($tag = null)
    {
        ($tag) ? $this->tag = $tag->id : '';
    }
    public function render()
    {
        //dd($this->tags);


        if (count($this->tags) <= 0) {
            array_push($this->tags, $this->tag);
            $tags = \Spatie\Tags\Tag::where('id', $this->tag)->first();
            if ($tags) {
                $blogs = Post::withAllTags([$tags], 'posts')->orderBy('id', 'desc')
                    ->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
            }
        } else {
            if (is_array($this->tags)) {
                $tags  = \Spatie\Tags\Tag::whereIn('id', $this->tags)->get();
                $blogs = Post::withAllTags($tags->pluck('name')->toArray(), 'posts')->orderBy('id', 'desc')
                    ->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
            }
        }

        return view('livewire.front-end.blog-tags', ['blogs' => $blogs]);
    }

    public function updatingPageNumber(): void
    {
        if ($this->PageNumber && is_numeric($this->PageNumber)) {
            $this->gotoPage($this->PageNumber);
        }
    }

    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
