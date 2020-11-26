<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Order_lines extends Model
{
    use LogsActivity;
    protected $table = 'order_lines';
    protected $guarded = [];

    protected static $logName = 'orders_items';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "orders_items-{$eventName}";
    }

    public function Order() {
        return $this->belongsTo(Order::class);
    }
    public function seller() {
        return $this->belongsTo(User::class);
    }
}
