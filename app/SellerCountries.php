<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerCountries extends Model
{
    protected $table = 'seller_countries';
    protected $guarded = [];

    public function setting() {
        return $this->belongsTo('App\Setting', 'setting_id', 'id');
    }

}
