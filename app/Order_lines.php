<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_lines extends Model
{
    protected $table = 'order_lines';
    protected $guarded = [];

    public function Order() {
        return $this->belongsTo(Order::class);
    }
    public function seller() {
        return $this->belongsTo(User::class);
    }
}
