<?php

namespace App;

use App\ShippingCompany;
use App\Zone;
use App\Product;
use App\Range;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Spatie\Activitylog\Traits\LogsActivity;

class Shipping_methods extends Model
{
    use Cachable, LogsActivity;
    protected $table = 'shipping_methods';
    protected $guarded = [];

    protected static $logName = 'shipping_methods';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "shipping_methods-{$eventName}";
    }

    public function shippingcompany() {
        return $this->belongsTo(ShippingCompany::class,'company_id', 'id');
    }

    public function zone() {
        return $this->belongsTo(Zone::class,'zone_id', 'id');
    }

    public function rates() {
        return $this->hasMany(Range::class,'method_id', 'id');
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'product_shipping_method','product_id','shipping_method_id');
    }
}
