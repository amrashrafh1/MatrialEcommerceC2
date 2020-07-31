<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    protected $table = 'settings';
    protected $guarded = [];

    public $translatable = ['sitename','system_message'];
    public $timestamps = false;


    public function seller_countries()
    {
        return $this->hasMany('App\SellerCountries', 'setting_id', 'id');
    }

    public function shipping()
    {
        return $this->belongsTo('App\Shipping_methods', 'shipping_method', 'id');
    }

}
