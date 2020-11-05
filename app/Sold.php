<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sold extends Model
{
    protected $table = 'solds';
    protected $guarded = [];

    public function product() {
        return $this->belongsTo('\App\Product', 'product_id', 'id');
    }

    protected $casts = [
        'options' => 'array', // Will convarted to (Array)
    ];
}
