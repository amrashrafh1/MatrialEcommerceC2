<?php

namespace App\Http\Livewire;

use App\Category;
use App\Product;
use Auth;
use Livewire\Component;

class Tag extends Component
{
    public $tag;
    public $tags       = [];
    public $sortBy     = 'newness';
    public $PerPage    = 20;
    public $PageNumber = 1;
    public $tab        = '';

    public function mount($tag = null)
    {
        ($tag) ? $this->tag = $tag->id : '';
    }
    public function render()
    {
        $categories = Category::where('status', 1)->inRandomOrder('id')->limit(20)->get();

        if (count($this->tags) <= 0) {
            array_push($this->tags, $this->tag);
            $tags = \Spatie\Tags\Tag::where('id', $this->tag)->first();

            if ($this->sortBy === 'newess') {
                $products = Product::isApproved()->withAllTags([$tags], 'products')
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type', 'short_description', 'stock', 'tradmark_id')
                    ->orderBy('id', 'desc')
                    ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
            } elseif ($this->sortBy === 'price-asc') {
                $products = Product::isApproved()->withAllTags([$tags], 'products')
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type', 'short_description', 'stock', 'tradmark_id')
                    ->orderBy('sale_price', 'asc')
                    ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
            } elseif ($this->sortBy === 'price-desc') {
                $products = Product::isApproved()->withAllTags([$tags], 'products')
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type', 'short_description', 'stock', 'tradmark_id')
                    ->orderBy('sale_price', 'desc')
                    ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
            } else {
                $products = Product::isApproved()->withAllTags([$tags], 'products')
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type', 'short_description', 'stock', 'tradmark_id')
                    ->orderBy('id', 'desc')
                    ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
            }
        } else {
            if (is_array($this->tags)) {
                $tags = \Spatie\Tags\Tag::whereIn('id', $this->tags)->where('type', 'products')->get();

                if ($this->sortBy === 'newess') {
                    $products = Product::isApproved()->withAllTags($tags->pluck('name')->toArray(), 'products')
                        ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type', 'short_description', 'stock', 'tradmark_id')
                        ->orderBy('id', 'desc')
                        ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
                } elseif ($this->sortBy === 'price-asc') {
                    $products = Product::isApproved()->withAllTags($tags->pluck('name')->toArray(), 'products')
                        ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type', 'short_description', 'stock', 'tradmark_id')
                        ->orderBy('sale_price', 'asc')
                        ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
                } elseif ($this->sortBy === 'price-desc') {
                    $products = Product::isApproved()->withAllTags($tags->pluck('name')->toArray(), 'products')
                         ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type', 'short_description', 'stock', 'tradmark_id')
                        ->orderBy('sale_price', 'desc')
                        ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
                } else {
                    $products = Product::isApproved()->withAllTags($tags->pluck('name')->toArray(), 'products')
                        ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type', 'short_description', 'stock', 'tradmark_id')
                        ->orderBy('id', 'desc')
                        ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
                }
            }
        }

        return view('livewire.tag', ['products' => $products, 'categories' => $categories,
             'tab' => $this->tab]);
    }

    public function updatingPageNumber(): void
    {
        if ($this->PageNumber && is_numeric($this->PageNumber)) {
            $this->gotoPage($this->PageNumber);
        }
    }

    public function addCart($id)
    {
        if (is_numeric($id) && $id) {
            $product = Product::find($id);
            if ($product) {
                \Cart::add($product, 1);
                $this->emit('cartAdded');
            }
        }
    }

    public function wishlists($id)
    {
        if (Auth::check()) {
            if (auth()->user()->wishlists()->disableCache()->pluck('product_id')->contains($id)) {
                auth()->user()->wishlists()->disableCache()->detach($id);
                $this->emit('wishlistAdded');
            } else {
                auth()->user()->wishlists()->disableCache()->attach($id);
                $this->emit('wishlistAdded');

            }
        }
    }
    public function compare($id)
    {
        if (session()->get('compare') !== null) {
            if (!in_array($id, session()->get('compare'))) {
                $this->emit('compareAdded');
                session()->push('compare', $id);
            } else {
                return;
            }
        } else {
            $this->emit('compareAdded');
            session()->push('compare', $id);
        }

    }

    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
