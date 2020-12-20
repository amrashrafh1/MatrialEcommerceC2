<?php

namespace App;

use App\Attribute;
use App\Category;
use App\Discount;
use App\Files;
use App\SellerInfo;
use App\Shipping_methods;
use App\Tradmark;
use App\User;
use App\Variation;
use Codebyray\ReviewRateable\Contracts\ReviewRateable;
use Codebyray\ReviewRateable\Traits\ReviewRateable as ReviewRateableTrait;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use DB;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Translatable\HasTranslations;
use Treestoneit\ShoppingCart\Buyable;
use Treestoneit\ShoppingCart\BuyableTrait;
use Treestoneit\ShoppingCart\Models\CartItem;
use Treestoneit\ShoppingCart\Taxable;

class Product extends Model implements Searchable, Buyable, ReviewRateable, Taxable, Viewable
{
    use HasTranslations, LogsActivity, BuyableTrait, ReviewRateableTrait, \Spatie\Tags\HasTags, Cachable, InteractsWithViews;
    protected $table = 'products';
    protected $guarded = [];
    protected $cachePrefix = "products-prefix";
    protected $removeViewsOnDelete = true;
    public $translatable = ['name', 'description', 'short_description', 'size', 'color', 'meta_tag',
        'meta_description', 'meta_keyword'];

    protected $casts = [
        'data' => 'array', // Will convarted to (Array)

    ];
    protected static $logName = 'products';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "products-{$eventName}";
    }
    /* attributes many to many */

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    /* variations attributes products many to many */

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    public function accessories()
    {
        return $this->belongsToMany(Product::class, 'product_product', 'producted_id', 'product_id');
    }

    /* shipping method many to many */
    public function methods()
    {
        return $this->belongsToMany(Shipping_methods::class, 'product_shipping_method', 'product_id', 'shipping_method_id');
    }

    public function gallery()
    {
        return $this->morphMany(Files::class, 'relation');
    }

    public function carts()
    {
        return $this->morphMany(CartItem::class, 'buyable');
    }

    /* search package */

    public function getSearchResult(): SearchResult
    {
        $url = route('products.edit', $this->id);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    public function store()
    {
        return $this->belongsTo(SellerInfo::class, 'seller_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function already_sold()
    {
        return $this->hasMany(Sold::class, 'product_id', 'id')->sum('sold');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tradmark()
    {
        return $this->belongsTo(Tradmark::class);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }
    /* public function ratings()
    {
    return $this->morphMany(Rating::class, 'reviewrateable');
    } */

    public function IsVariable()
    {
        if ($this->product_type === 'variable') {
            return true;
        }

        return false;
    }

    // check if the product is visible and approved

    public function IsAvailable()
    {
        if ($this->visible === 'visible' && $this->approved) {
            return true;
        }

        return false;
    }

    // check if the product is visible and approved
    public function isVisibleApproved()
    {
        return $this->where('visible', 'visible');
    }

    // get all product that visible and approved
    public function scopeIsApproved($query)
    {
        return $query->where('visible', 'visible')->where('approved', 1);
    }
    public function scopeHasDiscount($query)
    {
        return $query->where('visible', 'visible')->where('approved', 1)
            ->whereHas('discount', function ($d) {
                $d->where([['start_at', '<=', \Carbon\Carbon::now()], ['expire_at', '>', \Carbon\Carbon::now()],
                    ['condition', 'percentage_of_product_price']])
                    ->orWhere([['start_at', '<=', \Carbon\Carbon::now()], ['condition', 'fixed_amount'],
                        ['expire_at', '>', \Carbon\Carbon::now()]])->orderBy('id', 'desc');
            });
    }

    public function calc_price()
    {
        return $this->sale_price;
    }

    public function priceDiscount()
    {
        if ($this->available_discount()) {

            if ($this->discount->condition === 'percentage_of_product_price') {

                return ($this->sale_price - ($this->discount->amount / 100 * $this->sale_price));

            } elseif ($this->discount->condition === 'fixed_amount') {

                return ($this->sale_price - $this->discount->amount);

            }
        }
        return 0;
    }

    public function available_discount()
    {
        if (isset($this->discount)) {
            if ($this->discount->start_at <= \Carbon\Carbon::now() && $this->discount->expire_at > \Carbon\Carbon::now()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function IsPercentage_of_product_price()
    {
        if ($this->available_discount()) {

            if ($this->discount->condition === 'percentage_of_product_price') {

                return true;
            }
            return false;
        }
        return false;
    }
    public function IsFixed_amount()
    {
        if ($this->available_discount()) {

            if ($this->discount->condition === 'fixed_amount') {

                return true;

            }

            return false;

        }
        return false;
    }

    public function calcShipping($method, $qty)
    {
        if ($method->rule === 'flat_rate_per_order') {

            return $method->value;
        } elseif ($method->rule === 'quantity_based_per_order') {

            return quantity_based_per_order($method, $qty);

        } elseif ($method->rule === 'price_based_per_order') {

            return $method->value / 100 * $this->sale_price;
        } elseif ($method->rule === 'flat_rate_per_item') {

            return $method->value * $qty;
        } elseif ($method->rule === 'weight_based_per_item') {

            return (floatval($this->weight) * $qty) * $method->value;
        } elseif ($method->rule === 'weight_based_per_order') {

            return weight_based_per_order($this->weight, $method, $qty);
            //return $method->value * (($this->weight *  / $method->weight);

        } elseif ($method->rule === 'price_based_per_item') {

            return ($method->value / 100 * $this->sale_price) * $qty;
        }
    }

    public function scopeProductsSortBy($query, $sort)
    {
        if ($sort === 'price-asc') {
            return $query->orderBy('sale_price', 'asc');
        } elseif ($sort === 'price-desc') {
            return $query->orderBy('sale_price', 'desc');
        } elseif ($sort === 'newness') {
            return $query->orderBy('id', 'desc');
        } elseif ($sort === 'popularity') {
            return $query->orderByUniqueViews();
        } else {
            return $query->withCount(['ratings as average_rating' => function ($query) {
                $query->where('approved', 1)->select(\DB::raw('coalesce(avg(rating),0)'));
            }])->orderByDesc('average_rating');
        }

    } //end of products

    //  cart package methods
    public function getOptions(): array
    {
        $attributes = $this->attributes()->select('name', 'id', 'family_id')->get();
        $family     = [];
        $attrs      = [];
        /* loop attributes and get parent who has this attributes [not all family] */

        $ids = $attributes->pluck('id');

        $family = Attribute_Family::whereHas('attributes', function ($q) use ($ids) {
            $q->whereIn('id', $ids);
        })->get();
        //array_push($family, $ff);
        foreach ($family as $fam) {
            $attrFilter = $this->attributes()->select('name', 'id', 'family_id')
            ->where('family_id', $fam->id)->get();
            array_push($attrs, [$fam->name => $attrFilter->pluck('id', 'name')->toArray()]);
        }
        return \Arr::collapse($attrs);
    }

    public function getBuyableDescription()
    {
        return $this->description;
    }

    public function getBuyablePrice()
    {

        if ($this->available_discount()) {
            return $this->priceDiscount();
        }

        return $this->calc_price();


    }

    public function getTaxRate()
    {
        if ($this->tax) {
            return $this->tax;
        }

        if (! $this->taxable) {
            return 0;
        }

        return 8;
    }

    public function calc_shippings($country)
    {
        $shippings = [];
        $country_id = $country->id;
        $methods = $this->methods()->where('status', 0)->whereHas('zone', function ($q) use ($country_id) {
            $q->whereHas('countries', function ($query) use ($country_id) {
                $query->where('id', $country_id);
            });
        })->get();
        if (count($methods) <= 0) {
            // will get the default shipping method if has this country
            $defaultShipping = config('app.setting');

            if ($defaultShipping->default_shipping == 1 && $defaultShipping->shipping !== null) {

                $isDefaultMethod = $defaultShipping->shipping()->where('status', 0)->whereHas('zone', function ($q) use ($country_id) {
                    $q->whereHas('countries', function ($query) use ($country_id) {
                        $query->where('id', $country_id);
                    });
                })->first();
                // push $defaultShipping to shippings array

                if ($isDefaultMethod !== null) {
                    array_push($shippings, $this->calcShipping($isDefaultMethod, 1));
                } else {
                    // if $defaultShipping empty remove this item from items array
                    return trans('user.shipping_not_available_in') . $country->country_name;
                }

            }
            // if $defaultShipping empty remove this item from items array
            if ($defaultShipping->default_shipping != 1 || $defaultShipping->shipping == null) {
                return trans('user.shipping_not_available_in') . $country->country_name;
            }
        } else {

            foreach ($methods as $method) {
                array_push($shippings, $this->calcShipping($method, 1));
            }
        }
        if (count($shippings) > 0) {
            return (min($shippings) == 0) ? trans('user.free_shipping') : trans('user.+shipping:') . curr(min($shippings));

        } else {
            return trans('user.shipping_not_available_in') . $country->country_name;
        }
    }

    public function getParentAttributes()
    {
        $id    = $this->id;
        $array = [];
        $vars  = $this->variations()->where('visible', 'visible')->with('attributes')
            ->get();
        foreach ($vars as $var) {
            foreach ($var->attributes()->get() as $attribute) {
                array_push($array, $attribute->id);
            }
        }
        $families = Attribute_Family::whereHas('attributes', function ($query) use ($id, $array) {
            $query->whereIn('id', $array)->whereHas('products', function ($q) use ($id) {
                $q->where('id', $id);
            });
        })->with(['attributes' => function ($query) use ($id, $array) {
            $query->whereIn('id', $array)->whereHas('products', function ($q) use ($id) {
                $q->where('id', $id);
            });
        }])->get();
        return $families;
    }
}
