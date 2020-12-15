<?php

namespace App;

use App\Attribute;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Treestoneit\ShoppingCart\Buyable;
use Treestoneit\ShoppingCart\BuyableTrait;
use Treestoneit\ShoppingCart\Taxable;
use Treestoneit\ShoppingCart\Models\CartItem;

class Variation extends Model implements Buyable, Taxable
{
    use BuyableTrait;

    protected $table = 'variations';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function carts()
    {
        return $this->morphMany(CartItem::class, 'buyable');
    }

    public function get_variation($ids = [])
    {

        return $this->attributes()->whereIn('id', $ids)->get();

    }

    public function priceDiscount()
    {
        if ($this->product->available_discount()) {

            if ($this->product->discount->condition === 'percentage_of_product_price') {

                return $this->sale_price - ($this->product->discount->amount / 100 * $this->sale_price);

            } elseif ($this->product->discount->condition === 'fixed_amount') {

                return $this->sale_price - $this->product->discount->amount;

            }
        }
        return $this->sale_price;
    }

    public function calc_price()
    {
        return $this->sale_price;
    }

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
        foreach ($family as $fam) {
            $attrFilter = $this->attributes()->select('name', 'id', 'family_id')
                ->where('family_id', $fam->id)->get();
            array_push($attrs, [$fam->name => $attrFilter->pluck('id', 'name')->toArray()]);
        }
        return \Arr::collapse($attrs);
    }

    public function getBuyableDescription()
    {
        return $this->product->description;
    }

    public function getBuyablePrice()
    {
        return $this->priceDiscount();

    }

    public function getTaxRate()
    {
        if ($this->product->tax) {
            return $this->product->tax;
        }

        if (! $this->taxable) {
            return 0;
        }

        return 8;
    }


    public function getSKUAttribute($value)
    {
        if ($this->exists) {
            return !empty($value) ? $value : $this->product->sku;
        }
        return null;
    }
    public function getSalePriceAttribute($value)
    {
        if ($this->exists) {
            return !empty($value) ? $value : $this->product->sale_price;
        }
        return null;
    }
    public function getPurchasePriceAttribute($value)
    {
        if ($this->exists) {
            return !empty($value) ? $value : $this->product->purchase_price;
        }
        return null;
    }

    public function getStockAttribute($value)
    {
        if ($this->exists) {
            return !empty($value) ? $value : $this->product->stock;
        }
        return null;
    }

}
