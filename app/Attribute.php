<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use \App\Attribute_Family;
use App\Product;
use App\Variation;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Attribute extends Model
{
    use HasTranslations, Cachable;

    protected $table = 'attributes';
    protected $fillable = [
        'name',
        'family_id'
    ];
    public $translatable = ['name'];


    public function attribute_family() {
        return $this->belongsTo(Attribute_Family::class);
    }


    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function productsSortBy($sort)
    {
        if($sort === 'price-asc') {
            return $this->hasMany(Product::class)->orderBy('sale_price','asc');
        } elseif($sort === 'price-desc') {
            return $this->hasMany(Product::class)->orderBy('sale_price','desc');
        }elseif($sort === 'newness') {
            return $this->hasMany(Product::class)->orderBy('id','desc');
        } else {
            return $this->hasMany(Product::class)->orderBy('id','desc');
        }

    }//end of products


    public function variations() {
        return $this->hasMany(Variation::class);
    }
}
