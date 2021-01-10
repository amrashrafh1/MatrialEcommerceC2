<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelLocalization;
use Auth;
use App\Setting;
use App\Category;
use App\Shipping_methods;
use DB;
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

        $direction  = (LaravelLocalization::getCurrentLocaleDirection() === 'rtl') ? 'right' :'left';
        $setting    = Setting::latest('id')->with('shipping')->first();
        $categories = Category::where('status', 1)->where('parent_id', NULL)->with('categories')->get();
        \View::composer('*', function ($view) use ($setting){

            $compare    = (session()->get('compare'))?session()->get('compare'):[];

            if(session('country')) {
                $country_id = session('country');
            } else {
                $country_id = (\Auth::check())? (auth()->user()->country_id) ? auth()->user()->country_id:1:1;
            }
            $country    = DB::table('countries')->where('id', $country_id)->first();
            $methods    = Shipping_methods::where('status', 0)->whereHas('zone', function ($q) use ($country_id) {
                $q->whereHas('countries', function ($query) use ($country_id) {
                    $query->where('id', $country_id);
                });
            })->get();

            $isDefaultMethod = $setting->shipping->where('status', 0)->whereHas('zone', function ($q) use ($country_id) {
                $q->whereHas('countries', function ($query) use ($country_id) {
                    $query->where('id', $country_id);
                });
            })->first();
            if(!\Str::contains($view->path, ['admin', 'Admin'])) {
                $countries  = DB::table('countries')->select('country_name','id')->get();
                view()->share('countries', $countries);
            }

            view()->share('compare', $compare);
            view()->share('methods', $methods);
            view()->share('country', $country);
            view()->share('isDefaultMethod', $isDefaultMethod);
        });
        \Config::set('app.setting', $setting);
        view()->share('direction', $direction);
        view()->share('setting', $setting);
        view()->share('categories', $categories);

    }
}
