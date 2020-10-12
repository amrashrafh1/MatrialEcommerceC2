<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelLocalization;
use Auth;
use App\Setting;
use App\Category;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        LaravelLocalization::setLocale();

        $direction           = (LaravelLocalization::getCurrentLocaleDirection() === 'rtl') ? 'right' :'left';
        $setting             = Setting::latest('id')->first();
        $categories          = Category::where('status', 1)->where('category_id', NULL)->with('categories')->get();

        \View::composer('*', function ($view) {
            $wishlist_product_id = (Auth::check())?auth()->user()->wishlists()->disableCache()->pluck('product_id'):collect();
            $compare             = (session()->get('compare'))?session()->get('compare'):[];
            view()->share('wishlist_product_id', $wishlist_product_id);
            view()->share('compare', $compare);
        });
        \Config::set('app.setting', $setting);

        view()->share('direction', $direction);
        view()->share('setting', $setting);
        view()->share('categories', $categories);

    }
}
