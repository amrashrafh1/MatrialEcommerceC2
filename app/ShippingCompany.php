<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Zone;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class ShippingCompany extends Model
{
    use HasTranslations,Cachable;
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


    public  function zones () {
        return $this->belongsToMany(Zone::class);
    }

    public function methods() {
        return $this->hasMany(Shipping_methods::class, 'company_id', 'id');
    }
}
