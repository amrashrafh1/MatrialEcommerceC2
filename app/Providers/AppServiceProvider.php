<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelLocalization;
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
        $direction =  (\LaravelLocalization::getCurrentLocaleDirection() === 'rtl') ? 'right' :'left';
        view()->share('direction', $direction);

    }
}
