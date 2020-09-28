<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $guarded = [];


    public function countries()
    {
        return $this->belongsToMany('App\Country');
    }
}
