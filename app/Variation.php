<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use App\Attribute;
class Variation extends Model
{
    protected $table = 'variations';
    protected $guarded = [];


    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function attributes() {
        return $this->belongsToMany(Attribute::class);
    }

    public function get_variation($ids = []) {

        return $this->attributes()->whereIn('id', $ids)->get();

    }

    public function priceDiscount($product, $price) {
        if($product->available_discount()) {

        if($product->discount->condition === 'percentage_of_product_price') {

            return  $price - ($product->discount->amount / 100 * $price) + ($product->tax * $price) / 100;

        } elseif($product->discount->condition === 'fixed_amount') {

            return $price - $product->discount->amount + ($product->tax * $price) / 100;

        }
    }
        return $price + ($product->tax * $price) / 100;
    }
}
