<?php

namespace App;

use App\ShippingCompany;
use App\Zone;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Shipping_methods extends Model
{
    use Cachable;
    protected $table = 'shipping_methods';
    protected $guarded = [];


    public function shippingcompany() {
        return $this->belongsTo(ShippingCompany::class,'company_id', 'id');
    }

    public function zone() {
        return $this->belongsTo(Zone::class,'zone_id', 'id');
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'product_shipping_method','product_id','shipping_method_id');
    }
}
