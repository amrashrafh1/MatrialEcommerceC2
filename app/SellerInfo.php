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
}
