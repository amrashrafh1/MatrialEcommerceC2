<?php

namespace App\Http\Livewire\FrontEnd;

use Livewire\Component;
use Livewire\WithPagination;
use App\Attribute;
use App\Attribute_Family;
use App\Product;
use App\Tradmark;
use App\Category;
use DB;
use Auth;
class Brand extends Component
{
    use WithPagination;

    public $PerPage = 20;
    public $sortBy = 'newness';
    public $assId;
    public $ass_attrs  = [];
    public $PageNumber = 1;
    public $tab        = '';
    public $brand;

    public function mount($brand = [])
    {
        if ($brand) {
            $this->brand = $brand;
            $this->assId = $brand->id;
        } else {
            $this->brand = [];
        }
    }

    public function render()
    {

        if ($this->brand) {

            $brand_id   = $this->brand->id;
            $categories = Category::where('status', 1)->inRandomOrder('id')->limit(20)->get();
            $brands     = Tradmark::where('id', $brand_id)->get();

            $attributes = Attribute::whereHas('products', function ($q) use ($brand_id) {
                    $q->where('tradmark_id', $brand_id)
                    ->where('visible', 'visible')->where('approved', 1)
                    ->select('name','approved','short_description', 'image','tradmark_id', 'sale_price', 'sku', 'id', 'slug', 'product_type');
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
            $products = brand_sort($brand_id, $this->assId, $this->ass_attrs, $this->sortBy, $this->PerPage);
        }

        return view('livewire.front-end.brand', [
            'products' => $products,     'categories' => $categories,
            'brands'   => $brands,   'attributes' => $attributes, 'family' => $family, 'tab' => $this->tab]);
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

    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
