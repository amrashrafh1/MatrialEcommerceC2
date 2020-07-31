<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use \App\Attribute;
use \App\Attribute_Family;
use \App\Category;
use \App\Product;
use \App\Tradmark;
use DB;
class Shop extends Component
{
    use WithPagination;

    public $PerPage = 20;
    public $sortBy = 'newness';
    public $assId;
    public $category = [];
    public $ass_attrs = [];
    public $PageNumber = 1;

    public function mount($category = [])
    {
        if ($category) {
            $this->category = $category;
        } else {
            $this->category = [];
        }
    }

    public function render()
    {
        $pros = [];

        if ($this->category) {

            $cat_id     = $this->category->id;
            $categories = Category::where('status', 1)->inRandomOrder('id')->limit(20)->get();
            $brands     = Tradmark::whereHas('products', function ($q) use ($cat_id) {
                $q->where('category_id', $cat_id)->where('visible', 'visible')->where('approved', 1);
            })->inRandomOrder('id')->get();

            $attributes = Attribute::whereHas('products', function ($q) use ($cat_id) {
                    $q->where('category_id', $cat_id)
                    ->where('visible', 'visible')->where('approved', 1)
                    ->select('name','approved','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type');
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
            if ($this->sortBy === 'popularity') {
                $products = visits('App\Product')->top(20);
                $total = $result->count();
                $pageSize = (is_numeric($this->PerPage)) ? $this->PerPage : 20;
                $products = CollectionHelper::paginate($result, $total, $pageSize);
            } else {
                if ($this->sortBy === 'rating') {
                    $pros = [];
                    if (is_numeric($this->assId) && $this->assId) {
                        $trad = Tradmark::where('id', $this->assId)->first();
                        if ($trad) {
                            if ($this->ass_attrs && is_array($this->ass_attrs)) {
                                $attr_id = $this->ass_attrs;
                                $pros = Product::IsApproved()->where('tradmark_id', $trad->id)
                                    ->where('category_id', $cat_id)
                                    ->whereHas('attributes', function ($q) use ($attr_id) {
                                        $q->whereIn('id', $attr_id);
                                    })
                                    ->withCount(['ratings as average_rating' => function ($query) {
                                        $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                                    }])->orderByDesc('average_rating')
                                    ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
                            } else {
                                $pros = Product::IsApproved()->where('tradmark_id', $trad->id)
                                    ->where('category_id', $cat_id)
                                    ->withCount(['ratings as average_rating' => function ($query) {
                                        $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                                    }])->orderByDesc('average_rating')
                                    ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
                            }
                        }
                    }

                    if ($this->ass_attrs && is_array($this->ass_attrs)) {

                        $attr_id = $this->ass_attrs;
                        $products = Product::IsApproved()->where('category_id', $cat_id)
                            ->withCount(['ratings as average_rating' => function ($query) {
                                $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                            }])->orderByDesc('average_rating')
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
                    } else {
                        $products = Product::IsApproved()->where('category_id', $cat_id)
                            ->withCount(['ratings as average_rating' => function ($query) {
                                $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                            }])->orderByDesc('average_rating')
                            ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
                    }
                } else {
                    $pros = [];
                    if (is_numeric($this->assId) && $this->assId) {
                        $pros = Tradmark::where('id', $this->assId)->first();
                        if ($pros) {
                            if ($this->ass_attrs && is_array($this->ass_attrs)) {
                                $attr_id = $this->ass_attrs;
                                $pros = Tradmark::where('id', $this->assId)->first()->productsSortBy($this->sortBy)
                                    ->where('category_id', $cat_id)
                                    ->whereHas('attributes', function ($q) use ($attr_id) {
                                        $q->whereIn('id', $attr_id);
                                    })
                                    ->where('visible', 'visible')
                                    ->where('approved', 1)
                                    ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                                    ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
                            } else {
                                $pros = Tradmark::where('id', $this->assId)->first()->productsSortBy($this->sortBy)
                                    ->where('category_id', $cat_id)
                                    ->where('visible', 'visible')
                                    ->where('approved', 1)
                                    ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                                    ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
                            }
                        }
                    }

                    if ($this->ass_attrs && is_array($this->ass_attrs)) {

                        $attr_id = $this->ass_attrs;
                        $products = $this->category->productsSortBy($this->sortBy)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
                    } else {

                        $products = $this->category->productsSortBy($this->sortBy)
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($this->PerPage)) ? $this->PerPage : 20);
                    }
                }
            }
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
            $brands = Tradmark::inRandomOrder('id')->get();
            $attributes = Attribute::get();
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
            if (is_numeric($this->assId) && $this->assId) {
                $pros = shop_sort_products($this->assId, $this->ass_attrs, $this->sortBy, $this->PerPage);
                $products = [];
            } else {
                $products = shop_sort_products($this->assId, $this->ass_attrs, $this->sortBy, $this->PerPage);
            }
        }
        return view('livewire.shop', [
            'products' => $products,
            'pros'     => $pros,     'categories' => $categories,
            'brands'   => $brands,   'attributes' => $attributes, 'family' => $family]);
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
}
