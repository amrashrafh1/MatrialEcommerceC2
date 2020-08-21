<?php
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
 /* FrontEnd route */


Route::group(['prefix' => 'admin', 'middleware' => ['role:superadministrator|administrator']], function() {
    /* Users Management Start*/
	Route::resource('user', 'Admin\UserController', ['except' => ['show']]);
    Route::delete('users/destroy/all', 'Admin\UserController@destroy_all')->name('admins_destroy_all');
    /* Users Management End*/
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'Admin\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'Admin\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'Admin\ProfileController@password']);


    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
	Route::get('table-list', function () {
		return view('Admin.pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('Admin.pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('Admin.pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('Admin.pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('Admin.pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('Admin.pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('Admin.pages.upgrade');
    })->name('upgrade');

	Route::get('show/app/{id}', 'Admin\ApplicationController@index')->name('show_app');
	Route::post('accept/app/{id}', 'Admin\ApplicationController@accept')->name('accept_app');

    Route::resource('categories', 'Admin\CategoryController');
        Route::post('/categories/multi_delete', 'Admin\CategoryController@destory_all')->name('categories_destroy_all');

        Route::resource('tradmarks', 'Admin\TradmarkController');
        Route::post('/tradmarks/multi_delete', 'Admin\TradmarkController@destory_all')->name('tradmarks_destroy_all');

        Route::get('settings', 'Admin\SettingController@index')->name('settings');
        Route::patch('settings', 'Admin\SettingController@update')->name('settings_update');

        Route::resource('cmss', 'Admin\EventCategoryController');
        Route::post('cmss/multi_delete', 'Admin\EventCategoryController@destory_all')->name('event_category_delete_all');
        Route::get('cmss/products/{id}', 'Admin\EventCategoryController@create_products')->name('cmss_create_products');
        Route::get('cmss/category/{id}', 'Admin\EventCategoryController@create_category')->name('cmss_create_category');

    /* Start CMS */
        // Team
        Route::resource('teams', 'Admin\cms\TeamController');
        Route::post('/teams/multi_delete', 'Admin\cms\TeamController@destory_all')->name('teams_destroy_all');

        // Testimonials
        Route::resource('testimonials', 'Admin\cms\TestimonialController');
        Route::post('/testimonials/multi_delete', 'Admin\cms\TestimonialController@destory_all')->name('testimonials_destroy_all');

        // services
        Route::resource('services', 'Admin\cms\ServiceController');
        Route::post('/services/multi_delete', 'Admin\cms\ServiceController@destory_all')->name('services_destroy_all');

        // ourworks
        Route::resource('ourworks', 'Admin\cms\OurworkController');
        Route::post('/ourworks/multi_delete', 'Admin\cms\OurworkController@destory_all')->name('ourworks_destroy_all');

        // ContactUs
        Route::resource('contact_us', 'Admin\cms\ContactUsController');
        Route::post('/contact_us/multi_delete', 'Admin\cms\ContactUsController@destory_all')->name('contact_us_destroy_all');

        Route::resource('sliders', 'Admin\cms\SliderController');
        Route::post('/sliders/multi_delete', 'Admin\cms\SliderController@destory_all')->name('sliders_destroy_all');

        /* End CMS */
        // Adz
        Route::resource('adzs', 'Admin\AdzController');
        Route::post('/adzs/multi_delete', 'Admin\AdzController@destory_all')->name('adzs_destroy_all');

        Route::resource('manufacturers', 'Admin\ManufacturerController');
        Route::post('/manufacturers/multi_delete', 'Admin\ManufacturerController@destory_all')->name('manufacturers_destroy_all');

        Route::resource('shippingcompanies', 'Admin\ShippingCompanyController');
        Route::post('/shippingcompanies/multi_delete', 'Admin\ShippingCompanyController@destory_all')->name('shippingcompanies_destroy_all');

        Route::resource('zones', 'Admin\Shipping_ZoneController');
        Route::post('/zones/multi_delete', 'Admin\Shipping_ZoneController@destory_all')->name('zones_destroy_all');

        Route::resource('methods', 'Admin\Shipping_MethodsController');
        Route::post('/methods/multi_delete', 'Admin\Shipping_MethodsController@destory_all')->name('methods_destroy_all');


        Route::resource('countries', 'Admin\CountryController',['except' => ['store', 'create', 'edit', 'update']]);
        Route::post('/countries/multi_delete', 'Admin\CountryController@destory_all')->name('countries_destroy_all');

        Route::resource('cities', 'Admin\CityController');
        Route::post('/cities/multi_delete', 'Admin\CityController@destory_all')->name('cities_destroy_all');

        Route::resource('malls', 'Admin\MallController');
        Route::post('/malls/multi_delete', 'Admin\MallController@destory_all')->name('malls_destroy_all');

        Route::resource('posts', 'Admin\PostController');
        Route::post('/posts/multi_delete', 'Admin\PostController@destory_all')->name('posts_destroy_all');


        Route::resource('attribute_families', 'Admin\Attribute_FamilyController');
        Route::post('/attribute_families/multi_delete', 'Admin\Attribute_FamilyController@destory_all')->name('attribute_families_destroy_all');


        Route::resource('products', 'Admin\ProductController');
        Route::get('products/approved/{id}', 'Admin\ProductController@approved')->name('products.approved');
        Route::get('products/reviews/{id}', 'Admin\ProductController@reviews')->name('products.reviews');
        Route::get('products/reviews/approve/{id}', 'Admin\ProductController@reviews_approve')->name('products.reviews.approve');


        Route::get('seller/products', 'Admin\ProductController@sellers')->name('seller_products');
        Route::post('/products/multi_delete', 'Admin\ProductController@destory_all')->name('products_destroy_all');
        Route::get('/products/accessories/{id}', 'Admin\ProductController@add_accessories')->name('add_accessories');

        Route::resource('discounts', 'Admin\DiscountController',['except' => ['show']]);
        Route::post('/discounts/multi_delete', 'Admin\DiscountController@destory_all')->name('discounts_destroy_all');
        Route::resource('coupons', 'Admin\CouponController',['except' => ['show']]);
        Route::post('/coupons/multi_delete', 'Admin\CouponController@destory_all')->name('coupons_destroy_all');

        Route::resource('attributes', 'Admin\AttributeController');

        Route::put('attributes/create/{id}', 'Admin\AttributeController@store')->name('attribute_store');
        Route::patch('attributes/update/{id}', 'Admin\AttributeController@update')->name('attribute_update');

        Route::get('get/attributes/{id}', function(Request $request,$id) {
                $attributes = \App\Attribute::where('family_id', $id)->get();
                return json_encode($attributes);
        });

        /* Change color on dashboard (on: app.blade.php) */
        Route::post('changecolor', function (Request $request) {
            if(Cookie::get('color') != NULL) {
                Cookie::forget('color');
            }
            $cookie = Cookie::forever('color', $request['color']);
            return Response::make('test')->withCookie($cookie);
        })->name('changecolor'); //End changecolor


        /* Change image on dashboard (on: app.blade.php) */
        Route::post('changeimage', function (Request $request) {
            if(Cookie::get('image') != NULL) {
                Cookie::forget('image');
            }
            $cookie = Cookie::forever('image', $request['image']);
            return Response::make('test')->withCookie($cookie);
        })->name('changeimage'); // End changeimage


        Route::get('add/variations/{id}', 'Admin\VariationController@index')->name('product_variations');
        Route::post('store/variations/{id}', 'Admin\VariationController@store')->name('store_variations');
        Route::post('update/variations/{id}', 'Admin\VariationController@update')->name('update_variations');


    Route::get('/markasread', function () {
        auth()->user()->unreadNotifications()->where('type', 'App\Notifications\NotificationSent')->delete();
        return 'success';
    });
    Route::get('/markasread/{id}', function ($id) {

        $notification = auth()->user()->notifications->where('type', 'App\Notifications\ProductNotifications')->where('id', $id)->first();
        if($notification) {
            $notification->delete();
        }
        return 'success';
    });

    Route::get('/markallasread', function () {

        $notification = auth()->user()->notifications()->where('type', 'App\Notifications\ProductNotifications');
        $notification->delete();
        return 'success';
    });




    //fullcalender
    Route::get('fullcalendar','FullCalendarController@index');
    Route::post('fullcalendar/create','FullCalendarController@create');
    Route::post('fullcalendar/update','FullCalendarController@update');
    Route::post('fullcalendar/delete','FullCalendarController@destroy');

    Route::get('currencies', 'Admin\CurrencyController@index');
    Route::post('enable/currency/{id}', 'Admin\CurrencyController@update');

    Route::resource('seller', 'Admin\SellerController');
    Route::post('/seller/multi_delete', 'Admin\SellerController@destory_all')->name('seller_destroy_all');


    Route::resource('orders', 'Admin\OrderController',['except' => ['create', 'store','destroy']]);
    Route::post('/orders/edit_delete', 'Admin\OrderController@update')->name('orders_edit_all');


    Route::post('/get/companies/zone/{id}', function($id) {
        $zone = \App\Zone::find($id);
        return $zone->shippingcompanies;
    });


    Route::get('result', 'Admin\SearchController@result');
    //Route::post('projects/media', 'Admin\ProductController@storeMedia')
 // ->name('projects.storeMedia');
});
});
Addchat::routes();
