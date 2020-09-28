<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Slider extends Model
{
    use Cachable;

    protected $table   = 'sliders';
    protected $guarded = [];
    protected $cachePrefix = "sliders-prefix";


    public function scopeIsActive($query) {
        return $query->where('status',1);
    }
}
