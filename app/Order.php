<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use Cachable,LogsActivity;
    protected $table = 'orders';
    protected $guarded = [];

    protected static $logName = 'orders';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "orders-{$eventName}";
    }

    public function order_lines() {
        return $this->hasMany(Order_lines::class);
    }
    public function order_lines_seller() {
        if(auth()->user()->hasRole('seller')) {
            return $this->order_lines()->where('seller_id', auth()->user()->id);
        }
    }

}
