<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Zone;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Spatie\Activitylog\Traits\LogsActivity;

class ShippingCompany extends Model
{
    use HasTranslations,Cachable,LogsActivity;
    protected $table = 'shipping_companies';
    protected $fillable = [
        'name',
        'facebook',
        'twitter',
        'website',
        'contact_name',
        'address',
        'mobile',
        'email',
        'icon',
        'country_id'
    ];
    public $translatable = ['name'];

    protected static $logName = 'shipping_companies';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "shipping_companies-{$eventName}";
    }

    public  function zones () {
        return $this->belongsToMany(Zone::class);
    }

    public function methods() {
        return $this->hasMany(Shipping_methods::class, 'company_id', 'id');
    }
}
