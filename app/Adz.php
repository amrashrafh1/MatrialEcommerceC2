<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adz extends Model
{
    protected $table = 'adzs';
    protected $guarded = [];


    public function scopeAvailable($query) {
        return $query->where('status', 1)->where('start_at', '<=', \Carbon\Carbon::now())
        ->where('expire_at', '>', \Carbon\Carbon::now());
    }
}
