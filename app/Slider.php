<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table   = 'sliders';
    protected $guarded = [];


    public function scopeIsActive($query) {
        return $query->where('status',1);
    }
}
