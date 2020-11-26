<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
{
    use HasTranslations, Cachable,LogsActivity;

    protected $table = 'cities';
    protected $fillable = [
        'city_name',
        'country_id'
    ];
    public $translatable = ['city_name'];

    protected static $logName = 'cities';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "cities-{$eventName}";
    }
}
