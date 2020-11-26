<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
//use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Product;
use App\SellerInfo;
use Cache;
use Spatie\Activitylog\Traits\LogsActivity;

use Gabievi\Promocodes\Traits\Rewardable;

class User extends Authenticatable implements Searchable, JWTSubject, MustVerifyEmail
{
    //use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
    use LaratrustUserTrait;
    use Notifiable;
    use SoftDeletes, Rewardable, LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected static $ignoreChangedAttributes = ['chat_status',
    'last_login_at',
    'last_login_ip',
    'updated_at'];

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'image',
        'phone',
        'address',
        'city',
        'state',
        'postcode',
        'country_id',
        'chat_status',
        'last_login_at',
        'last_login_ip'
    ];
    protected static $logName = 'users';

    protected static $logAttributes = [
        'name',
        'last_name',
        'email',
        'image',
        'phone',
        'address',
        'city',
        'state',
        'postcode',
        'country_id',
        'chat_status',
        'last_login_at',
        'last_login_ip'
    ];

    protected static $logOnlyDirty = true;

public function getDescriptionForEvent(string $eventName) :string
    {
        return "users-{$eventName}";
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //protected static $logFillable = true;
    //protected static $logUnguarded = true;
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function getSearchResult(): SearchResult
    {
        $url = route('user.edit', $this->id);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    public function wishlists() {
        return $this->belongsToMany(Product::class,'wishlists', 'user_id','product_id');
    }


    public function stores() {
        return $this->hasMany(SellerInfo::class, 'seller_id','id');
    }

    public function products() {

        return $this->hasMany(Product::class, 'user_id','id');

    }

    public function orders() {
        return $this->hasMany(Order::class, 'user_id','id');
    }


    public function followee () {
        return $this->belongsToMany(SellerInfo::class, 'seller_info_user','follower_id','followee_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'm_from');
    }

    public function unReadedMessages()
    {
        return $this->hasMany(Message::class, 'm_to')->where('is_read', 0);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-'. $this->id);
    }
}
