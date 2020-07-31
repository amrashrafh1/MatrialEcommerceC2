<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class City extends Model
{
    use HasTranslations, Cachable;

    protected $table = 'cities';
    protected $fillable = [
        'city_name',
        'country_id'
    ];
    public $translatable = ['city_name'];

}
