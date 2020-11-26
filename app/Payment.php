<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{
    use LogsActivity;
    protected $table = 'payments';
    protected $guarded = [];

    protected static $logName = 'payments';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "payments-{$eventName}";
    }
    public function countries()
    {
        return $this->belongsToMany('App\Country');
    }
}
