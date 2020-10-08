<?php

namespace App;

use App\Attribute;
use App\Category;
use App\Discount;
use App\Files;
use App\Shipping_methods;
use App\Tradmark;
use App\User;
use App\Variation;
use Codebyray\ReviewRateable\Contracts\ReviewRateable;
use Codebyray\ReviewRateable\Traits\ReviewRateable as ReviewRateableTrait;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Translatable\HasTranslations;
use Treestoneit\ShoppingCart\Buyable;
use Treestoneit\ShoppingCart\BuyableTrait;
use Treestoneit\ShoppingCart\Taxable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Treestoneit\ShoppingCart\Models\CartItem;

class Product extends Model implements Searchable, Buyable, ReviewRateable, Taxable,Viewable
{
    use HasTranslations, BuyableTrait, ReviewRateableTrait, \Spatie\Tags\HasTags, Cachable, InteractsWithViews;
    protected $table               = 'products';
    protected $guarded             = [];
    protected $cachePrefix         = "products-prefix";
    protected $removeViewsOnDelete = true;
    public    $translatable        = ['name', 'description', 'size', 'color', 'meta_tag',
     'meta_description', 'meta_keyword'];

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

    public function seller()
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


    public function IsVariable()
    {
        if($this->product_type === 'variable') {
            return true;
        }

        return false;
    }

    // check if the product is visible and approved

    public function IsAvailable()
    {
        if($this->visible === 'visible' && $this->approved) {
            return true;
        }

        return false;
    }

    // check if the product is visible and approved
    public function isVisibleApproved()
    {
        return $this->where('visible', 'visible')->where('approved', 1);
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
            $d->where('condition', 'percentage_of_product_price')
                ->orWhere('condition', 'fixed_amount')
                ->where('start_at', '<=', \Carbon\Carbon::now())
                ->where('expire_at', '>', \Carbon\Carbon::now())->orderBy('id', 'desc');
        });
    }



    public function calc_price()
    {
        return $this->sale_price + ($this->tax * $this->sale_price) / 100;
    }
    public function priceDiscount()
    {
        if ($this->available_discount()) {

            if ($this->discount->condition === 'percentage_of_product_price') {

                return $this->sale_price - ($this->discount->amount / 100 * $this->sale_price) + ($this->tax * $this->sale_price) / 100;

            } elseif ($this->discount->condition === 'fixed_amount') {

                return $this->sale_price - $this->discount->amount + ($this->tax * $this->sale_price) / 100;

            }
        }
        return $this->sale_price + ($this->tax * $this->sale_price) / 100;
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
        $family = [];
        $attrs = [];
        /* loop attributes and get parent who has this attributes [not all family] */

        foreach ($attributes as $attr) {
            $id = $attr->id;
            $ff = Attribute_Family::whereHas('attributes', function ($q) use ($id) {
                $q->where('id', $id);
            })->first();

            if (!in_array($ff, $family)) {
                array_push($family, $ff);
            }
        }
        foreach ($family as $fam) {

            $attrFilter = $this->attributes()->select('name', 'id', 'family_id')->where('family_id', $fam->id)->get();
            array_push($attrs, [$fam->name => $attrFilter->pluck('name')->toArray()]);
        }
        return \Arr::collapse($attrs);
    }

    public function getBuyableDescription()
    {
        return $this->description;
    }

    public function getBuyablePrice()
    {
        if ($this->IsVariable()) {
            foreach (\Cart::content() as $cart) {
                if ($cart->buyable->id === $this->id) {
                    foreach ($this->variations as $variation) {
                        if (count($variation->attributes()->pluck('name')->diff(array_values($cart->options))) === 0) {
                            if ($variation['visible'] === 'hidden' || $variation->in_stock === 'out_stock') {
                                if (isset($this->discount)) {
                                    if ($this->discount->condition === 'percentage_of_product_price'
                                        && $this->discount->start_at <= \Carbon\Carbon::now()
                                        && $this->discount->expire_at > \Carbon\Carbon::now()) {

                                        return $this->sale_price - ($this->discount->amount / 100 * $this->sale_price) + ($this->tax / 100 * $this->sale_price);

                                    } elseif ($this->discount->condition === 'fixed_amount'
                                        && $this->discount->start_at <= \Carbon\Carbon::now()
                                        && $this->discount->expire_at > \Carbon\Carbon::now()) {

                                        return $this->sale_price - $this->discount->amount + ($this->tax / 100 * $this->sale_price);

                                    }
                                    return $variation->sale_price + ($this->tax / 100 * $variation->sale_price);
                                } else {
                                    return $this->sale_price + ($this->tax / 100 * $this->sale_price);
                                }
                            } else {
                                if (isset($this->discount)) {
                                    if ($this->discount->condition === 'percentage_of_product_price'
                                        && $this->discount->start_at <= \Carbon\Carbon::now()
                                        && $this->discount->expire_at > \Carbon\Carbon::now()) {

                                        return $variation->sale_price - ($this->discount->amount / 100 * $variation->sale_price) + ($this->tax / 100 * $variation->sale_price);

                                    } elseif ($this->discount->condition === 'fixed_amount'
                                        && $this->discount->start_at <= \Carbon\Carbon::now()
                                        && $this->discount->expire_at > \Carbon\Carbon::now()) {

                                        return $variation->sale_price - $this->discount->amount + ($this->tax / 100 * $variation->sale_price);

                                    }

                                    return $variation->sale_price + ($this->tax / 100 * $variation->sale_price);
                                } else {

                                    return $variation->sale_price + ($this->tax / 100 * $variation->sale_price);
                                }
                            }
                        }
                    }
                    return $this->sale_price + ($this->tax / 100 * $this->sale_price);
                }
            }
        } else {
            if (isset($this->discount)) {
                if ($this->discount->condition === 'percentage_of_product_price'
                    && $this->discount->start_at <= \Carbon\Carbon::now()
                    && $this->discount->expire_at > \Carbon\Carbon::now()) {

                    return $this->sale_price - ($this->discount->amount / 100 * $this->sale_price) + ($this->tax / 100 * $this->sale_price);

                } elseif ($this->discount->condition === 'fixed_amount'
                    && $this->discount->start_at <= \Carbon\Carbon::now()
                    && $this->discount->expire_at > \Carbon\Carbon::now()) {

                    return $this->sale_price - $this->discount->amount + ($this->tax / 100 * $this->sale_price);

                }
            }

            return $this->sale_price + ($this->tax / 100 * $this->sale_price);
        }

    }

    public function getTaxRate()
    {
        if ($this->tax) {
            return $this->tax;
        }

        if (!$this->taxable) {
            return 0;
        }

        return 8;
    }



}
