<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Attribute;
use Spatie\Activitylog\Traits\LogsActivity;

class Attribute_Family extends Model
{

    use HasTranslations, LogsActivity;

    protected $table    = 'attribute__families';
    protected $fillable = [
        'name'
    ];
    public $translatable = ['name'];
    protected static $logName = 'attribute_families';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "attribute_families-{$eventName}";
    }

    public function attributes() {
        return $this->hasMany(Attribute::class, 'family_id', 'id');
    }
}
