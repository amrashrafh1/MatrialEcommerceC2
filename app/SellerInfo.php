<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Spatie\Activitylog\Traits\LogsActivity;

class SellerInfo extends Model implements Viewable
{
    use InteractsWithViews,LogsActivity;

    protected $table = 'seller_infos';
    protected $guarded = [];
    protected $removeViewsOnDelete = true;

    protected static $logName = 'stores';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "stores-{$eventName}";
    }
    public function seller()
    {
        return $this->belongsTo('App\User');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function followers () {
        return $this->belongsToMany(User::class, 'seller_info_user','followee_id','follower_id');
    }


    public function products() {

        return $this->hasMany(Product::class, 'seller_id', 'id');
    }
}
