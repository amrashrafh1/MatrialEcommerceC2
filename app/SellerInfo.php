<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerInfo extends Model
{
    protected $table = 'seller_infos';
    protected $guarded = [];

    public function seller()
    {
        return $this->belongsTo('App\User');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function followers () {
        return $this->belongsToMany(User::class, 'seller_info_user','followee_id','follower_id');
    }


    public function products() {

        return $this->hasMany(Product::class, 'seller_id', 'id');
    }
}
