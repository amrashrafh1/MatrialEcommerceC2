<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Order extends Model
{
    use Cachable;
    protected $table = 'orders';
    protected $guarded = [];

    public function order_lines() {
        return $this->hasMany(Order_lines::class);
    }
    public function order_lines_seller() {
        if(auth()->user()->hasRole('seller')) {
            return $this->order_lines()->where('seller_id', auth()->user()->id);
        }
    }

}
