<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class, 'm_from');
    }
    public function product()
    {
    	return $this->belongsTo(Product::class, 'product_id');
    }
}
