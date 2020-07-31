<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
use App\Category;
class Tag extends Component
{
    public $tag;
    public $tags       = [];
    public $sortBy     = 'newness';
    public $PerPage    = 20;
    public $PageNumber = 1;

    public function mount($tag) {
        $this->tag = $tag->id;
    }
    public function render()
    {
        $categories = Category::where('status', 1)->inRandomOrder('id')->limit(20)->get();

        if(count($this->tags) <= 0) {
            array_push($this->tags, $this->tag);
            $tags     = \Spatie\Tags\Tag::where('id', $this->tag)->first();

            if($this->sortBy === 'newess') {
            $products = Product::withAllTags([$tags])
            ->where('visible', 'visible')
            ->select('name','image','sale_price','sku','id','slug','product_type')
            ->orderBy('id', 'desc')
            ->paginate((is_numeric($this->PerPage))?$this->PerPage:20);
            } elseif($this->sortBy === 'price-asc') {
                $products = Product::withAllTags([$tags])
                ->where('visible', 'visible')
                ->select('name','image','sale_price','sku','id','slug','product_type')
                ->orderBy('sale_price', 'asc')
                ->paginate((is_numeric($this->PerPage))?$this->PerPage:20);
            }
            elseif($this->sortBy === 'price-desc') {
                $products = Product::withAllTags([$tags])
                ->where('visible', 'visible')
                ->select('name','image','sale_price','sku','id','slug','product_type')
                ->orderBy('sale_price', 'desc')
                ->paginate((is_numeric($this->PerPage))?$this->PerPage:20);
            } else {
                $products = Product::withAllTags([$tags])
                ->where('visible', 'visible')
                ->select('name','image','sale_price','sku','id','slug','product_type')
                ->orderBy('id', 'desc')
                ->paginate((is_numeric($this->PerPage))?$this->PerPage:20);
            }
        } else {
            if(is_array($this->tags)) {
            $tags     = \Spatie\Tags\Tag::whereIn('id', $this->tags)->get();
            if($this->sortBy === 'newess') {
                $products = Product::withAllTags($tags->pluck('name')->toArray())
                ->where('visible', 'visible')
                ->select('name','image','sale_price','sku','id','slug','product_type')
                ->orderBy('id', 'desc')
                ->paginate((is_numeric($this->PerPage))?$this->PerPage:20);
                } elseif($this->sortBy === 'price-asc') {
                    $products = Product::withAllTags($tags->pluck('name')->toArray())
                    ->where('visible', 'visible')
                    ->select('name','image','sale_price','sku','id','slug','product_type')
                    ->orderBy('sale_price', 'asc')
                    ->paginate((is_numeric($this->PerPage))?$this->PerPage:20);
                }
                elseif($this->sortBy === 'price-desc') {
                    $products = Product::withAllTags($tags->pluck('name')->toArray())
                    ->where('visible', 'visible')
                    ->select('name','image','sale_price','sku','id','slug','product_type')
                    ->orderBy('sale_price', 'desc')
                    ->paginate((is_numeric($this->PerPage))?$this->PerPage:20);
                } else {
                    $products = Product::withAllTags($tags->pluck('name')->toArray())
                    ->where('visible', 'visible')
                    ->select('name','image','sale_price','sku','id','slug','product_type')
                    ->orderBy('id', 'desc')
                    ->paginate((is_numeric($this->PerPage))?$this->PerPage:20);
                }
            }
        }
        return view('livewire.tag', ['products' => $products, 'categories' => $categories]);
    }


    public function updatingPageNumber(): void
    {
        if($this->PageNumber && is_numeric($this->PageNumber)) {
            $this->gotoPage($this->PageNumber);
        }
    }
}
