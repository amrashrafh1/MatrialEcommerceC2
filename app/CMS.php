<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Spatie\Activitylog\Traits\LogsActivity;

class CMS extends Model implements Viewable
{
    use HasTranslations, InteractsWithViews,LogsActivity;


    protected $table        = 'c_m_s_s';
    protected $guarded      = [];
    public    $translatable = ['menuTitle', 'title','content','meta_tag','meta_keyword','meta_description'];
    protected $removeViewsOnDelete = true;

    protected static $logName = 'events';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "events-{$eventName}";
    }

    public function categories() {
        return $this->belongsToMany('App\Category', 'c_m_s__category', 'c_m_s_id', 'category_id');
    }
    public function products() {
        return $this->belongsToMany('App\Product', 'c_m_s__product', 'c_m_s_id', 'product_id');
    }



    public function productsSortBy($sort)
    {
        if($sort === 'price-asc') {
            return \App\Product::whereIn('category_id',$this->categories->pluck('id'))->orderBy('sale_price','asc');
        } elseif($sort === 'price-desc') {
            return \App\Product::whereIn('category_id',$this->categories->pluck('id'))->orderBy('sale_price','desc');
        }elseif($sort === 'newness') {
            return \App\Product::whereIn('category_id',$this->categories->pluck('id'))->orderBy('id','desc');
        } else {
            return \App\Product::whereIn('category_id',$this->categories->pluck('id'))->orderBy('id','desc');
        }

    }//end of products

    public function scopeIsExpired ($query) {
        return $query->where('start_at','<=', \Carbon\Carbon::now())->where('expire_at','>', \Carbon\Carbon::now());
    }
}
