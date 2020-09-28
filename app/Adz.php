<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Adz extends Model
{
    use Cachable;
    protected $table = 'adzs';
    protected $guarded = [];
    protected $cachePrefix = "adz-prefix";


    public function scopeAvailable($query) {
        return $query->where('status', 1)->where('start_at', '<=', \Carbon\Carbon::now())
        ->where('expire_at', '>', \Carbon\Carbon::now());
    }
}
