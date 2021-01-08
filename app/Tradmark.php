<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Tradmark extends Model
{
    use HasTranslations, LogsActivity;

    protected $table = 'tradmarks';
    protected $fillable = [
        'name',
        'logo',
        'slug',
    ];
    public $translatable = ['name'];

    protected static $logName = 'tradmarks';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "tradmarks-{$eventName}";
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productsSortBy($sort)
    {
        if ($sort === 'price-asc') {
            return $this->hasMany(Product::class)->where('visible', 'visible')
                ->where('approved', 1)->with(['methods', 'discount', 'ratings' => function ($q) {
                    $q->where('approved', 1);
                }])->orderBy('sale_price', 'asc');
        } elseif ($sort === 'price-desc') {
            return $this->hasMany(Product::class)->where('visible', 'visible')
                ->where('approved', 1)->with(['methods', 'discount', 'ratings' => function ($q) {
                    $q->where('approved', 1);
                }])->orderBy('sale_price', 'desc');
        } elseif ($sort === 'newness') {
            return $this->hasMany(Product::class)->where('visible', 'visible')
                ->where('approved', 1)->with(['methods', 'discount', 'ratings' => function ($q) {
                    $q->where('approved', 1);
                }])->orderBy('id', 'desc');
        } elseif ($sort === 'popularity') {
            return $this->hasMany(Product::class)->where('visible', 'visible')
                ->where('approved', 1)->with(['methods', 'discount', 'ratings' => function ($q) {
                    $q->where('approved', 1);
                }])->orderByUniqueViews();
        } else {
            return $this->hasMany(Product::class)->where('visible', 'visible')
                ->where('approved', 1)->withCount(['ratings as average_rating' => function ($query) {
                $query->where('approved', 1)->select(\DB::raw('coalesce(avg(rating),0)'));
            }])->orderByDesc('average_rating');
        }

    } //end of products

    public function discountProductsSortBy($sort)
    {
        $query = $this->hasMany(Product::class)->where('visible', 'visible')
            ->where('approved', 1)
            ->whereHas('discount', function ($d) {
                $d->where('condition', 'percentage_of_product_price')
                    ->orWhere('condition', 'fixed_amount')
                    ->where('start_at', '<=', \Carbon\Carbon::now())
                    ->where('expire_at', '>', \Carbon\Carbon::now())->orderBy('id', 'desc');
            });
            if ($sort === 'price-asc') {
            return $query->orderBy('sale_price', 'asc');

        } elseif ($sort === 'price-desc') {
            return $query->orderBy('sale_price', 'desc');

        } elseif ($sort === 'newness') {
            return $query->orderBy('id', 'desc');

        } elseif ($sort === 'popularity') {
            return $query->orderByUniqueViews();
        } else {
            return $query->withCount(['ratings as average_rating' => function ($query) {
                $query->where('approved', 1)->select(\DB::raw('coalesce(avg(rating),0)'));
            }])->orderByDesc('average_rating');
        }

    } //end of products
}
