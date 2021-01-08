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
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ], function () { //...
        /* FrontEnd route */

        Route::group(['prefix' => 'admin', 'middleware' => ['role:superadministrator|administrator']], function () {
            /* Users Management Start*/
            Route::resource('user', 'Admin\UserController', ['except' => ['show']]);
            Route::delete('users/destroy/all', 'Admin\UserController@destroy_all')->name('admins_destroy_all');
            /* Users Management End*/
            Route::get('profile', ['as' => 'profile.edit', 'uses' => 'Admin\ProfileController@edit']);
            Route::put('profile', ['as' => 'profile.update', 'uses' => 'Admin\ProfileController@update'])->middleware('image-sanitize');;
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

            // seller application
            Route::get('show/app/{id}', 'Admin\ApplicationController@index')->name('show_app');

            Route::get('activities', 'Admin\ActivityController@index');
            Route::get('activities/{id}', 'Admin\ActivityController@show')->name('activities.show');

            Route::post('accept/app/{id}', 'Admin\ApplicationController@accept')->name('accept_app');
            Route::delete('reject/app/{id}', 'Admin\ApplicationController@reject')->name('reject_app');

            // resources
            Route::resources([
                '/products'           => 'Admin\ProductController',
                '/attribute_families' => 'Admin\Attribute_FamilyController',
                '/posts'              => 'Admin\PostController',
                '/malls'              => 'Admin\MallController',
                '/cities'             => 'Admin\CityController',
                '/methods'            => 'Admin\Shipping_MethodsController',
                '/zones'              => 'Admin\Shipping_ZoneController',
                '/shippingcompanies'  => 'Admin\ShippingCompanyController',
                '/manufacturers'      => 'Admin\ManufacturerController',
                '/adzs'               => 'Admin\AdzController',
                '/sliders'            => 'Admin\cms\SliderController',
                '/contact_us'         => 'Admin\cms\ContactUsController',
                '/ourworks'           => 'Admin\cms\OurworkController',
                '/services'           => 'Admin\cms\ServiceController',
                '/testimonials'       => 'Admin\cms\TestimonialController',
                '/teams'              => 'Admin\cms\TeamController',
                '/cmss'               => 'Admin\EventCategoryController',
                '/tradmarks'          => 'Admin\TradmarkController',
                '/categories'         => 'Admin\CategoryController',
                '/seller'             => 'Admin\SellerController',
                '/orders'             => 'Admin\OrderController',
                '/payments'           => 'Admin\PaymentController',
            ]);

            Route::resource('seller.stores', 'Admin\StoreController', ['except' => ['show', 'edit', 'update']]);
            Route::get('store/reviews/{id}', 'Admin\StoreController@reviews')->name('store.reviews');
            Route::get('store/reviews/approve/{id}', 'Admin\StoreController@reviews_approve')->name('store.reviews.approve');

            Route::post('/stores/multi_delete', 'Admin\StoreController@destory_all')->name('stores_destroy_all');

            Route::post('/categories/multi_delete', 'Admin\CategoryController@destory_all')->name('categories_destroy_all');

            Route::post('/tradmarks/multi_delete', 'Admin\TradmarkController@destory_all')->name('tradmarks_destroy_all');

            Route::post('/payments/multi_delete', 'Admin\PaymentController@destory_all')->name('payments_destroy_all');

            Route::get('settings', 'Admin\SettingController@index')->name('settings');
            Route::patch('settings', 'Admin\SettingController@update')->name('settings_update')->middleware('image-sanitize');;

            Route::post('cmss/multi_delete', 'Admin\EventCategoryController@destory_all')->name('event_category_delete_all');
            Route::get('cmss/products/{id}', 'Admin\EventCategoryController@create_products')->name('cmss_create_products');
            Route::get('cmss/category/{id}', 'Admin\EventCategoryController@create_category')->name('cmss_create_category');
            /* Start CMS */

            // Team
            Route::post('/teams/multi_delete', 'Admin\cms\TeamController@destory_all')->name('teams_destroy_all');

            // Testimonials
            Route::post('/testimonials/multi_delete', 'Admin\cms\TestimonialController@destory_all')->name('testimonials_destroy_all');

            // services
            Route::post('/services/multi_delete', 'Admin\cms\ServiceController@destory_all')->name('services_destroy_all');

            // ourworks
            Route::post('/ourworks/multi_delete', 'Admin\cms\OurworkController@destory_all')->name('ourworks_destroy_all');

            // ContactUs
            Route::post('/contact_us/multi_delete', 'Admin\cms\ContactUsController@destory_all')->name('contact_us_destroy_all');

            Route::post('/sliders/multi_delete', 'Admin\cms\SliderController@destory_all')->name('sliders_destroy_all');

            /* End CMS */
            // Adz
            Route::post('/adzs/multi_delete', 'Admin\AdzController@destory_all')->name('adzs_destroy_all');

            Route::post('/manufacturers/multi_delete', 'Admin\ManufacturerController@destory_all')->name('manufacturers_destroy_all');

            Route::post('/shippingcompanies/multi_delete', 'Admin\ShippingCompanyController@destory_all')->name('shippingcompanies_destroy_all');

            Route::post('/zones/multi_delete', 'Admin\Shipping_ZoneController@destory_all')->name('zones_destroy_all');

            Route::post('/methods/multi_delete', 'Admin\Shipping_MethodsController@destory_all')->name('methods_destroy_all');

            Route::get('/methods/rates/{id}', 'Admin\Shipping_MethodsController@rates')->name('methods.rates');

            Route::post('/methods/rates/store/{id}', 'Admin\Shipping_MethodsController@rates_store')->name('methods.rates_store');

            Route::get('/methods/rates/edit/{id}', 'Admin\Shipping_MethodsController@rates_edit')->name('methods.rates_edit');

            Route::resource('countries', 'Admin\CountryController', ['except' => ['store', 'create', 'edit', 'update']]);
            Route::post('/countries/multi_delete', 'Admin\CountryController@destory_all')->name('countries_destroy_all');

            Route::post('/cities/multi_delete', 'Admin\CityController@destory_all')->name('cities_destroy_all');

            Route::post('/malls/multi_delete', 'Admin\MallController@destory_all')->name('malls_destroy_all');

            Route::post('/posts/multi_delete', 'Admin\PostController@destory_all')->name('posts_destroy_all');

            Route::post('/attribute_families/multi_delete', 'Admin\Attribute_FamilyController@destory_all')->name('attribute_families_destroy_all');

            Route::get('products/approved/{id}', 'Admin\ProductController@approved')->name('products.approved');
            Route::get('products/reviews/{id}', 'Admin\ProductController@reviews')->name('products.reviews');
            Route::get('products/reviews/approve/{id}', 'Admin\ProductController@reviews_approve')->name('products.reviews.approve');

            Route::get('/sellers/products', 'Admin\ProductController@sellers')->name('seller_products');
            Route::post('/products/multi_delete', 'Admin\ProductController@destory_all')->name('products_destroy_all');
            Route::get('/products/accessories/{id}', 'Admin\ProductController@add_accessories')->name('add_accessories');

            Route::resource('discounts', 'Admin\DiscountController', ['except' => ['show']]);
            Route::post('/discounts/multi_delete', 'Admin\DiscountController@destory_all')->name('discounts_destroy_all');
            Route::resource('coupons', 'Admin\CouponController', ['except' => ['show']]);
            Route::post('/coupons/multi_delete', 'Admin\CouponController@destory_all')->name('coupons_destroy_all');

            Route::get('attributes/create/{id}', 'Admin\AttributeController@create')->name('attributes.create');
            // Route::patch('attributes/update/{id}', 'Admin\AttributeController@update')->name('attribute_update');

            /* Route::get('get/attributes/{id}', function(Request $request,$id) {
            $attributes = \App\Attribute::where('family_id', $id)->get();
            return json_encode($attributes);
            }); */

            /* Change color on dashboard (on: app.blade.php) */
            Route::post('changecolor', function (Request $request) {
                if (Cookie::get('color') != null) {
                    Cookie::forget('color');
                }
                $cookie = Cookie::forever('color', $request['color']);
                return Response::make('test')->withCookie($cookie);
            })->name('changecolor'); //End changecolor

            /* Change image on dashboard (on: app.blade.php) */
            Route::post('changeimage', function (Request $request) {
                if (Cookie::get('image') != null) {
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
                if ($notification) {
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
            Route::get('fullcalendar', 'FullCalendarController@index');
            Route::post('fullcalendar/create', 'FullCalendarController@create');
            Route::post('fullcalendar/update', 'FullCalendarController@update');
            Route::post('fullcalendar/delete', 'FullCalendarController@destroy');

            Route::get('currencies', 'Admin\CurrencyController@index');
            Route::post('enable/currency/{id}', 'Admin\CurrencyController@update');

            //  Route::resource('seller', 'Admin\SellerController');

            Route::post('/seller/multi_delete', 'Admin\SellerController@destory_all')->name('seller_destroy_all');

            Route::post('/orders/edit_delete', 'Admin\OrderController@update')->name('orders_edit_all');

            Route::post('/get/companies/zone/{id}', function ($id) {
                $zone = \App\Zone::find($id);
                return $zone->shippingcompanies;
            });

            Route::get('result', 'Admin\SearchController@result');
            //Route::post('projects/media', 'Admin\ProductController@storeMedia')
            // ->name('projects.storeMedia');
        });
    });
Addchat::routes();
