<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Discount extends Model
{
    use Cachable;
    protected $table = 'discounts';
    protected $guarded = [];
    protected $cachePrefix = "discounts-prefix";

    public function product() {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
    public function productY() {
        return $this->belongsTo('App\Product', 'product_y', 'id');
    }



    public function price() {

        if($this->condition == 'percentage_of_product_price') {

            return  $this->product->sale_price - ($this->amount/100 * $this->sale_price);

        } elseif($this->condition == 'fixed_amount') {

            return $this->product->sale_price - $this->amount;

        }
    }

    public function scopeDiscountAvailable($query) {
        return $query->where('condition', 'percentage_of_product_price')
        ->orWhere('condition', 'fixed_amount')
        ->where('start_at', '<=', \Carbon\Carbon::now())
        ->where('expire_at', '>', \Carbon\Carbon::now())
        ->select('start_at', 'expire_at', 'condition', 'daily', 'product_id', 'id', 'amount');
    }
}
