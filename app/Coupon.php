<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'promocodes';
    protected $guarded = [];
    public $timestamps = false;



    public function scopeIsAuthUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }
}
