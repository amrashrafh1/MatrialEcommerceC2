<?php

namespace App\Http\Livewire;

use App\Events\cartEvent;
use App\Http\Controllers\CollectionHelper;
use DB;
use Livewire\Component;
use Livewire\WithPagination;
use \App\Attribute;
use \App\Attribute_Family;
use \App\Category;
use \App\Product;
use \App\Tradmark;

class CMS extends Component
{
    use WithPagination;

    public $PerPage = 20;
    public $sortBy = 'newness';
    public $assId;
    public $cms = [];
    public $ass_attrs = [];
    public $PageNumber = 1;

    public function mount($cms = [])
    {
        if ($cms->type == 'categories') {
            $this->cms = $cms;
        } else {
            $this->cms = $cms;
        }
    }

    public function render()
    {
        $pros = [];

        if ($this->cms->type == 'categories') {

            $cat_id     = $this->cms->categories->pluck('id');
            $categories = Category::where('status', 1)->whereIn('id',$cat_id)->inRandomOrder('id')->limit(20)->get();
            $brands     = Tradmark::whereHas('products', function ($q) use ($cat_id) {
                $q->whereIn('category_id', $cat_id);
            })->inRandomOrder('id')->get();

            $attributes = Attribute::whereHas('products', function ($q) use ($cat_id) {
                $q->whereIn('category_id', $cat_id)
                    ->where('visible', 'visible')
                    ->select('name','short_description','tax', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type');
            })->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
            $family = [];
            foreach ($attributes as $attr) {
                $id = $attr->id;
                $ff = Attribute_Family::whereHas('attributes', function ($q) use ($id) {
                    $q->where('id', $id);
                })->first();

                if (!in_array($ff, $family)) {
                    array_push($family, $ff);
                }
            }
            /* SortBy */
            $products = cms_page_categories($cat_id, $this->assId, $this->ass_attrs, $this->sortBy, $this->PerPage);
        } else {
            /*
             *    _____ _                   _____
             *   / ____| |                 |  __ \
             *  | (___ | |__   ___  _ __   | |__) |_ _  __ _  ___
             *   \___ \| '_ \ / _ \| '_ \  |  ___/ _` |/ _` |/ _ \
             *   ____) | | | | (_) | |_) | | |  | (_| | (_| |  __/
             *  |_____/|_| |_|\___/| .__/  |_|   \__,_|\__, |\___|
             *                     | |                  __/ |
             *                     |_|                 |___/
             *
             */
            $categories = Category::where('status', 1)->inRandomOrder('id')->limit(20)->get();
            $brands     = Tradmark::inRandomOrder('id')->get();
            $attributes = Attribute::get();
            $family     = [];
            foreach ($attributes as $attr) {
                $id = $attr->id;
                $ff = Attribute_Family::whereHas('attributes', function ($q) use ($id) {
                    $q->where('id', $id);
                })->first();

                if (!in_array($ff, $family)) {
                    array_push($family, $ff);
                }
            }
            /* SortBy */
            /* if (is_numeric($this->assId) && $this->assId) {
                $pros = sortProducts($this->assId, $this->cms->products->where('visible', 'visible')
                ->pluck('id'),$this->ass_attrs, $this->sortBy, $this->PerPage);
                $products = [];
            } else { */

                $products = cms_page_products($this->assId, $this->cms->products->where('visible', 'visible')
                ->where('approved', 1)
                ->pluck('id'),$this->ass_attrs, $this->sortBy, $this->PerPage);
           /*  } */

        }
        $compare = (session()->get('compare'))?session()->get('compare'):[];
        $wishlist_product_id = (\Auth::check())?auth()->user()->wishlists()->disableCache()->pluck('product_id'):[];

        return view('livewire.c-m-s', ['products' => $products,
            'pros' => $pros, 'categories' => $categories,
            'brands' => $brands, 'attributes' => $attributes, 'family' => $family, 'compare' => $compare,
            'wishlist_product_id' => $wishlist_product_id]);
    }

    public function updatingPageNumber(): void
    {
        if ($this->PageNumber && is_numeric($this->PageNumber)) {
            $this->gotoPage($this->PageNumber);
        }
    }
    public function updatingAssId(): void
    {
        $this->gotoPage(1);
    }
    public function updatingAss_attrs(): void
    {
        $this->gotoPage(1);
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

    public function wishlists($id) {
        if(Auth::check()) {
            if(auth()->user()->wishlists()->disableCache()->pluck('product_id')->contains($id)) {
                auth()->user()->wishlists()->disableCache()->detach($id);
                $this->emit('wishlistAdded');
            } else {
                auth()->user()->wishlists()->disableCache()->attach($id);
                $this->emit('wishlistAdded');

            }
        }
    }
    public function compare($id) {
        if(session()->get('compare') !== null) {
            if(!in_array($id,session()->get('compare'))) {
                $this->emit('compareAdded');
                session()->push('compare', $id);
            } else {
                return ;
            }
        } else {
            $this->emit('compareAdded');
            session()->push('compare', $id);
        }

    }
}
