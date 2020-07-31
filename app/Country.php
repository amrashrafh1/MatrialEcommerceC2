<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Zone;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Country extends Model implements Searchable
{
    use HasTranslations,Cachable;

    protected $table = 'countries';
    protected $guarded = [];
   // public $translatable = ['country_name'];

    protected $casts = [
        'callingCodes' => 'array',   // Will convarted to (Array)
        'languages'    => 'array',
        'currencies'   => 'array',
        'latlng'       => 'array',
        'timezones'    => 'array'
    ];
    public  function shipping_zone () {
        return $this->belongsToMany(Zone::class);
    }



    public function getSearchResult(): SearchResult
    {
        $url = route('result');

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->country_name,
            $url
        );
    }
}
