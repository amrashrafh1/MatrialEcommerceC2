<?php

namespace App\Http\Livewire;

use App\Attribute;
use App\Attribute_Family;
use App\Category;
use App\Product;
use App\Sold;
use App\Tradmark;
use Livewire\Component;
use Auth;
use Livewire\WithPagination;

class ProductCategory extends Component
{
    use WithPagination;

    public $PerPage = 20;
    public $sortBy = 'newness';
    public $assId;
    public $category   = [];
    public $ass_attrs  = [];
    public $PageNumber = 1;
    public $tab        = '';

    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $cat_id = $this->category->id;
        $cats_id = Category::where('id', $cat_id)
            ->with('categories')
            ->first();
        $cats_id = $this->getIds($cats_id);


        $brands     = Tradmark::whereHas('products', function ($q) use ($cats_id) {
            $q->whereIn('category_id', $cats_id)->isApproved();
        })->withCount(['products' => function ($q) use ($cats_id) {
            $q->whereIn('category_id', $cats_id)->isApproved();
        }])->inRandomOrder('id')->get();

        $attributes = Attribute::with('attribute_family')->whereHas('products', function ($q) use ($cats_id) {
            $q->whereIn('category_id', $cats_id)
                ->where('visible', 'visible')->where('approved', 1)
                ->select('name', 'approved', 'short_description', 'image', 'category_id','sale_price', 'sku', 'id', 'slug', 'product_type');
        })->disableCache()->get();
        $family = [];
        foreach ($attributes as $attr) {
            $id = $attr->id;
            if (!in_array($attr->attribute_family, $family)) {
                array_push($family, $attr->attribute_family);
            }
        }

        $latest_products = Product::isApproved()->whereIn('category_id', $cats_id)
        ->with(['discount', 'methods'])->take(10)->get();
        $best_offers     = Product::isApproved()->whereIn('category_id', $cats_id)->HasDiscount()
        ->with(['discount', 'methods'])->take(20)->get();
        $top_selling     = Product::isApproved()->whereIn('category_id', $cats_id)->addSelect(['sold' => Sold::selectRaw('sum(sold) as total')
                ->whereColumn('product_id', 'products.id')
                ->groupBy('product_id'),
        ])->with(['discount'])->orderBy('sold', 'DESC')->take(20)->get();

        $products = shop_sort($cats_id, null, $this->assId, $this->ass_attrs, $this->sortBy, $this->PerPage);
        return view('livewire.product-category', [
                'products'    => $products,    'brands'          => $brands,
                'attributes'  => $attributes,  'family'          => $family,
                'tab'         => $this->tab,   'latest_products' => $latest_products
              , 'best_offers' => $best_offers, 'top_selling'     => $top_selling]);
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
                if ($product->visible == 'visible' && $product->approved == 1) {
                    \Cart::add($product, 1);
                    $this->emit('cartAdded');
                }
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

    public function getIds($cat)
    {
        $ids = [$cat->id];

        foreach ($cat->categories->where('status', 1) as $child) {

            $ids = array_merge($ids, $this->getIds($child));
        }
        return $ids;
    }
}
