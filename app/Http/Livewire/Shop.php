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
use Auth;
class Shop extends Component
{
    use WithPagination;

    public $PerPage = 20;
    public $sortBy = 'newness';
    public $assId;
    public $category   = [];
    public $ass_attrs  = [];
    public $PageNumber = 1;
    public $tab        = '';

    public function render()
    {
            $categories = Category::where('status', 1)->inRandomOrder('id')->limit(20)->get();
            $brands     = Tradmark::whereHas('products', function ($q) {
                $q->isApproved();
            })->withCount(['products' =>  function ($q) {
                $q->isApproved();
            }])->inRandomOrder('id')->get();

            $attributes = Attribute::with('attribute_family')->whereHas('products', function ($q) {
                    $q->where('visible', 'visible')->where('approved', 1)
                    ->select('name','approved','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type');
            })->disableCache()->get();
            $family = [];
            foreach ($attributes as $attr) {
                $id = $attr->id;
                if (!in_array($attr->attribute_family, $family)) {
                    array_push($family, $attr->attribute_family);
                }
            }
            /* SortBy */
        $products = shop_sort(NULL,NULL, $this->assId, $this->ass_attrs, $this->sortBy, $this->PerPage);

        $latest_products = Product::with(['discount','methods'])->orderBy('id', 'DESC')->take(10)->get();

        return view('livewire.shop', [
            'products' => $products,    'categories' => $categories,
            'brands'   => $brands,   'attributes' => $attributes, 'family' => $family,
             'tab' => $this->tab, 'latest_products' => $latest_products]);
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
                if($product->visible == 'visible' && $product->approved == 1) {
                    \Cart::add($product, 1);
                    $this->emit('cartAdded');
                }
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

    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }

    /* public function getIds($cat)
    {
    $ids =  [$cat->id];

    foreach ($cat->categories->where('status', 1) as $child) {

        $ids = array_merge($ids, $this->getIds($child));
    }
    return $ids;
    } */
}
