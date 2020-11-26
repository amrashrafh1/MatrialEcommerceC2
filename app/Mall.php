<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Spatie\Activitylog\Traits\LogsActivity;

class Mall extends Model
{
    use HasTranslations,Cachable, LogsActivity;

    protected $table = 'malls';
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'facebook',
        'country_id',
        'twitter',
        'address',
        'website',
        'contact_name',
        'icon',
    ];
    public $translatable = ['name'];

    protected static $logName = 'malls';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "malls-{$eventName}";
    }

    public function country_id() {
        return $this->hasOne('App\Country', 'id', 'country_id');
    }
}
