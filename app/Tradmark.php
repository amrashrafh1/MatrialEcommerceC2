<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Product;
class Tradmark extends Model
{
    use HasTranslations;

    protected $table = 'tradmarks';
    protected $fillable = [
        'name',
        'logo',
        'slug'
    ];
    public $translatable = ['name'];


    public function products () {
        return $this->hasMany(Product::class);
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
}
