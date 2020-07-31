<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute_Product extends Model
{
    protected $table    = 'attribute_product';
    protected $fillable = [
        'product_id',
        'attribute_id'
    ];
}
