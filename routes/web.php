<?php
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::put('/product/variation/add/cart/{slug}', 'FrontEnd\ProductController@add_cart')->name('product_variation_add_cart');
Route::put('/product/add/accesssories', 'FrontEnd\ProductController@add_accesssories_cart')->name('product_add_accessories');

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
 /* FrontEnd route */


Auth::routes();
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');


Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'FrontEnd\ProductController@show')->name('show_product');
Route::post('/get/variations/data', 'FrontEnd\ProductController@get_data')->name('get_data');
Route::get('/category/{slug}', 'FrontEnd\ShopController@index')->name('show_category');
Route::get('/super-deal', 'FrontEnd\SuperDealController@index')->name('show_superdeal');
Route::get('/cart', function () {
    return view('FrontEnd.cart-page');
})->name('show_cart');
Route::get('/checkout', function () {
    return view('FrontEnd.checkout');
})->name('show_checkout');

Route::post('/checkout/store','FrontEnd\BillingController@store')->name('checkout_store');

Route::get('/compare', function () {
    return view('FrontEnd.compare');
})->name('show_compare');
Route::get('/wishlists', function () {
    return view('FrontEnd.wishlists');
})->name('show_wishlists')->middleware('auth');
Route::get('/shop', function () {
    return view('FrontEnd.shop');
})->name('shop');


/*
 *    _____      _ _             _____
 *   / ____|    | | |           |  __ \
 *  | (___   ___| | | ___ _ __  | |__) |_ _  __ _  ___  ___
 *   \___ \ / _ \ | |/ _ \ '__| |  ___/ _` |/ _` |/ _ \/ __|
 *   ____) |  __/ | |  __/ |    | |  | (_| | (_| |  __/\__ \
 *  |_____/ \___|_|_|\___|_|    |_|   \__,_|\__, |\___||___/
 *                                           __/ |
 *                                          |___/
 *
 */
Route::get('/seller/app', 'FrontEnd\SellerAppController@index')->name('seller_app');
Route::post('/seller/app', 'FrontEnd\SellerAppController@store')->name('store_app');
Route::get('/tag/{slug}','FrontEnd\TagController@index')->name('tags');
Route::get('/seller/dashboard','FrontEnd\SellerController@index')->name('seller_dashboard');
Route::get('/seller/products','FrontEnd\SellerController@products')->name('seller_frontend_products');
Route::get('/seller/products/create','FrontEnd\SellerController@create')->name('seller_frontend_products_create');
Route::post('/seller/products/store','FrontEnd\SellerController@store')->name('seller_frontend_products_store');
Route::get('/seller/products/edit/{slug}','FrontEnd\SellerController@edit')->name('seller_frontend_products_edit');
Route::put('/seller/products/edit/{slug}','FrontEnd\SellerController@update')->name('seller_frontend_products_update');
Route::delete('/seller/products/delete/{slug}','FrontEnd\SellerController@destroy')->name('seller_frontend_products_delete');
Route::delete('/seller/products/destroy/all', 'FrontEnd\SellerController@destory_all')->name('seller_frontend_products_destroy_all');
Route::get('/seller/products/variations/{slug}', 'FrontEnd\SellerController@variations')->name('seller_frontend_products_variations');
Route::post('/seller/products/variations/{slug}', 'FrontEnd\SellerController@variations_store')->name('seller_frontend_products_variations_store');
Route::post('/seller/products/variations/update/{slug}', 'FrontEnd\SellerController@variation_update')->name('seller_frontend_products_variations_update');
Route::get('/seller/products/accessories/{slug}', 'FrontEnd\SellerController@accessories')->name('seller_frontend_products_accessories');
Route::get('/seller/orders', 'FrontEnd\SellerController@orders')->name('seller_frontend_orders');
Route::get('/seller/orders/show/{id}', 'FrontEnd\SellerController@orders_show')->name('seller_frontend_orders_show');

/*
 *    _____      _ _             _____
 *   / ____|    | | |           |  __ \
 *  | (___   ___| | | ___ _ __  | |__) |_ _  __ _  ___  ___
 *   \___ \ / _ \ | |/ _ \ '__| |  ___/ _` |/ _` |/ _ \/ __|
 *   ____) |  __/ | |  __/ |    | |  | (_| | (_| |  __/\__ \
 *  |_____/ \___|_|_|\___|_|    |_|   \__,_|\__, |\___||___/
 *                                           __/ |
 *                                          |___/
 *
 */

Route::get('/event/show/{slug}', 'FrontEnd\EventController@cms_show')->name('cms_show');

/*
 *    _____      _ _             _____  _                           _
 *   / ____|    | | |           |  __ \(_)                         | |
 *  | (___   ___| | | ___ _ __  | |  | |_ ___  ___ ___  _   _ _ __ | |_
 *   \___ \ / _ \ | |/ _ \ '__| | |  | | / __|/ __/ _ \| | | | '_ \| __|
 *   ____) |  __/ | |  __/ |    | |__| | \__ \ (_| (_) | |_| | | | | |_
 *  |_____/ \___|_|_|\___|_|    |_____/|_|___/\___\___/ \__,_|_| |_|\__|
 *
 *
 *
 */

Route::get('/seller/discount/{id}', 'FrontEnd\DiscountController@create')->name('seller_add_discount');
Route::post('/seller/discount/store/{id}', 'FrontEnd\DiscountController@store')->name('seller_discount_store');
Route::get('/seller/discount/edit/{id}', 'FrontEnd\DiscountController@edit')->name('seller_discount_edit');
Route::post('/seller/discount/update/{id}', 'FrontEnd\DiscountController@update')->name('seller_discount_update');

/* End seller Discount */
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/invoice/{id}', 'FrontEnd\SellerController@export_invoice')->name('export_invoice');
Route::get('/seller/store/{id}', 'FrontEnd\SellerProfileController@show_seller')->name('show_seller');


/* Chat (Seller & Customer) */
Route::get('/chat/{slug}', 'FrontEnd\ChatController@seller')->middleware('auth')->name('show_chat');
Route::get('/chat', 'FrontEnd\ChatController@chat')->middleware('auth')->name('chat');


Route::get('/profile','FrontEnd\ProfileController@index')->name('profile');
Route::put('/profile/update','FrontEnd\ProfileController@update')->name('user_profile.update');
Route::put('/profile/password','FrontEnd\ProfileController@password')->name('user_profile.password');
Route::get('/profile/order/{id}','FrontEnd\ProfileController@order')->name('profile.order.show');

Route::get('cancel', 'FrontEnd\BillingController@cancel')->name('payment.cancel');
Route::get('payment/success', 'FrontEnd\BillingController@success')->name('payment.success');
Route::get('payment/successfully/', function () {
    if(session()->get('order') !== null) {
        return view('FrontEnd.success_page',['order' => session()->get('order')[0]]);
    } else {
        return redirect()->route('shop');
    }
})->name('success_page');





/* Admin Route */


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


    Route::resource('orders', 'Admin\OrderController',['except' => ['create', 'store','destroy','edit']]);
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
Route::match(['get', 'post'], '/botman', 'ChatBoxController@enterRequest');
