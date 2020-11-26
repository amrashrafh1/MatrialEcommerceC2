<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model implements Searchable, Viewable
{
    use HasTranslations, Cachable, InteractsWithViews,LogsActivity;
    protected $table = 'categories';
    protected $guarded = [];
    public $translatable = ['name', 'description', 'meta_tag',
    'meta_description', 'meta_keyword'];
    protected $removeViewsOnDelete = true;


    protected static $logName = 'categories';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "categories-{$eventName}";
    }
    public function products()
    {
        return $this->hasMany(Product::class)->orderBy('id','desc');

    }//end of products
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
    /* Categories parents and children */

    public function parent() {

        return $this->belongsTo(Category::class, 'category_id', 'id');

    }
    public function categories() {

        return $this->hasMany(Category::class);

    }


    public function childrenCategories() {
        return $this->hasMany(Category::class)->with('categories');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('categories.edit', $this->id);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }

}
