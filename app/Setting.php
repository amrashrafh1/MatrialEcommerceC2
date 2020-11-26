<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    use HasTranslations, LogsActivity;

    protected $table = 'settings';
    protected $guarded = [];

    public $translatable = ['sitename','system_message', 'meta_tag',
    'meta_description', 'meta_keyword'];
    public $timestamps = false;
    protected static $logName = 'settings';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "settings-{$eventName}";
    }
    public function seller_countries()
    {
        return $this->hasMany('App\SellerCountries', 'setting_id', 'id');
    }

    public function shipping()
    {
        return $this->belongsTo('App\Shipping_methods', 'shipping_method', 'id');
    }

}
