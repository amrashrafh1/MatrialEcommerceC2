<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Attribute;
class Attribute_Family extends Model
{

    use HasTranslations;

    protected $table    = 'attribute__families';
    protected $fillable = [
        'name'
    ];
    public $translatable = ['name'];


    public function attributes() {
        return $this->hasMany(Attribute::class, 'family_id', 'id');
    }
}
