<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Manufacturer extends Model
{
    use HasTranslations;

    protected $table = 'manufacturers';
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

}
