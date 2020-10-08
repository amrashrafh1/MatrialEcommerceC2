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


    public function already_used()
    {
        $already_used = \DB::table('promocode_user')
        ->where('user_id',auth()->user()->id)->where('promocode_id', $this->id)->first();
        if($already_used) {
            return false;
        }
        return true;
    }
}
