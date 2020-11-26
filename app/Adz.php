<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Spatie\Activitylog\Traits\LogsActivity;

class Adz extends Model
{
    use Cachable, LogsActivity;
    protected $table = 'adzs';
    protected $guarded = [];
    protected $cachePrefix = "adz-prefix";

    protected static $logName = 'advertizments';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "advertizments-{$eventName}";
    }

    public function scopeAvailable($query) {
        return $query->where('status', 1)->where('start_at', '<=', \Carbon\Carbon::now())
        ->where('expire_at', '>', \Carbon\Carbon::now());
    }
}
