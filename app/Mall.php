<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Mall extends Model
{
    use HasTranslations,Cachable;

    protected $table = 'malls';
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'facebook',
        'country_id',
        'twitter',
        'address',
        'website',
        'contact_name',
        'icon',
    ];
    public $translatable = ['name'];


    public function country_id() {
        return $this->hasOne('App\Country', 'id', 'country_id');
    }
}
