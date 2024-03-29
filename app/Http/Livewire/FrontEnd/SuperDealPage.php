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
            $brands = Tradmark::whereHas('products', function ($p) {
                $p->where('visible', 'visible')
                ->where('approved', 1)
                ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    });
            })
            ->with(['products'=> function ($p) {
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
                $products        = sortProductsDiscount($this->assId, $this->ass_attrs, $this->sortBy, $this->PerPage);
                $latest_products = Product::orderBy('id', 'DESC')->take(10)->get();


        return view('livewire.shop', ['products' => $products,
            'pros'   => $pros,   'categories' => $categories,
            'brands' => $brands, 'attributes' => $attributes,
            'family' => $family, 'tab'        => $this->tab,  'latest_products' => $latest_products]);
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
}
