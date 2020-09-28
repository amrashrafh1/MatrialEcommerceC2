<?php

namespace App\Http\Livewire\FrontEnd;

use App\Events\cartEvent;
use App\Http\Controllers\CollectionHelper;
use DB;
use Livewire\Component;
use Livewire\WithPagination;
use App\Attribute;
use App\Attribute_Family;
use App\Category;
use App\Product;
use App\Tradmark;
use Auth;
class SuperDealPage extends Component
{
    use WithPagination;

    public $PerPage = 20;
    public $sortBy = 'newness';
    public $assId;
    public $category = [];
    public $ass_attrs = [];
    public $PageNumber = 1, $tab = '';
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
            $categories = Category::where('status', 1)->inRandomOrder('id')->limit(20)->get();
            $brands = Tradmark::with(['products'=> function ($p) {
                $p->where('visible', 'visible')
                ->where('approved', 1)
                ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    });
            }])
            //->select('name', 'image', 'sale_price', 'sku','short_description', 'id', 'slug', 'product_type')
            ->inRandomOrder('id')->get();
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
            /* if (is_numeric($this->assId) && $this->assId) {
                $pros = sortProductsDiscount($this->assId, $this->ass_attrs, $this->sortBy, $this->PerPage);
                $products = [];
            } else { */
                $products = sortProductsDiscount($this->assId, $this->ass_attrs, $this->sortBy, $this->PerPage);
            /* } */
            $compare = (session()->get('compare'))?session()->get('compare'):[];
            $wishlist_product_id = (Auth::check())?auth()->user()->wishlists()->disableCache()->pluck('product_id'):[];

        return view('livewire.shop', ['products' => $products,
            'pros' => $pros, 'categories' => $categories,
            'brands' => $brands, 'attributes' => $attributes,
             'family' => $family,'tab' => $this->tab, 'wishlist_product_id' =>$wishlist_product_id
             , 'compare' => $compare]);
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
    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
