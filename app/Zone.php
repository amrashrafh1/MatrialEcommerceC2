<?php

namespace App;

use App\Country;
use App\ShippingCompany;
use App\Shipping_methods;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Zone extends Model
{
    use Cachable;
    protected $table = 'zones';
    protected $guarded = [];


    public  function countries () {
        return $this->belongsToMany(Country::class);
    }



    public  function shippingcompanies () {
        return $this->belongsToMany(ShippingCompany::class);
    }

    public  function methods () {
        return $this->hasMany(Shipping_methods::class, 'zone_id', 'id');
    }
}
