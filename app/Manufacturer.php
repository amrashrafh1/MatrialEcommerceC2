<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;

class Manufacturer extends Model
{
    use HasTranslations,LogsActivity;

    protected $table = 'manufacturers';
    protected $fillable = [
        'name',
        'facebook',
        'twitter',
        'website',
        'contact_name',
        'address',
        'mobile',
        'email',
        'icon',
        'country_id'
    ];
    public $translatable = ['name'];
    protected static $logName = 'manufacturers';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "manufacturers-{$eventName}";
    }
}
