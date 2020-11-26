<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Range extends Model
{
    use LogsActivity;
    protected $table   = 'ranges';
    protected $guarded = [];

    protected static $logName = 'ranges';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "ranges-{$eventName}";
    }
}
