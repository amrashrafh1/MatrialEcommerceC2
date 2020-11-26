<?php

namespace App;

use App\Country;
use App\ShippingCompany;
use App\Shipping_methods;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Spatie\Activitylog\Traits\LogsActivity;

class Zone extends Model
{
    use Cachable, LogsActivity;
    protected $table = 'zones';
    protected $guarded = [];

    protected static $logName = 'zones';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "zones-{$eventName}";
    }

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
