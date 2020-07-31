<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute_Variation extends Model
{
    protected $table = 'attribute__variation';

    protected $fillable = [
        'attribute_id',
        'variation_id'
    ];
}
