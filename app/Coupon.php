<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Coupon extends Model
{
    use LogsActivity;
    protected $table = 'promocodes';
    protected $guarded = [];
    public $timestamps = false;

    protected static $logName = 'coupons';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "coupons-{$eventName}";
    }

    public function scopeIsAuthUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }


    public function already_used()
    {
        $already_used = \DB::table('promocode_user')
        ->where('user_id',auth()->user()->id)->where('promocode_id', $this->id)->first();
        if($already_used) {
            return false;
        }
        return true;
    }
}
