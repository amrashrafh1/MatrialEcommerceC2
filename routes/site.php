<?php
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::put('/product/variation/add/cart/{slug}', 'FrontEnd\ProductController@add_cart')->name('product_variation_add_cart');
Route::put('/product/add/accesssories', 'FrontEnd\ProductController@add_accesssories_cart')->name('product_add_accessories');
Route::post('/chat/upload/photots/{id}', 'FrontEnd\ChatController@sendMessage')->name('sendMessage');

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

Route::get('/contact_us','FrontEnd\ContactUsController@index')->name('contact_us');
Route::post('/contact_us','FrontEnd\ContactUsController@store')->name('contact_us_store');

Route::post('/payment','FrontEnd\payment\BillingController@payment')->name('payment');

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
Route::get('/tag/{slug}','FrontEnd\TagController@index')->name('tags')
;
Route::get('/seller/app', 'FrontEnd\SellerAppController@index')->name('seller_app');
Route::post('/seller/app', 'FrontEnd\SellerAppController@store')->name('store_app');
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
Route::get('payment/success', 'FrontEnd\payment\BillingController@success')->name('payment.success');
Route::get('payment/successfully/', function () {
    if(session()->get('order') !== null) {
        return view('FrontEnd.success_page',['order' => session()->get('order')[0]]);
    } else {
        return redirect()->route('shop');
    }
})->name('success_page');



// Start Pages
Route::get('teams', 'FrontEnd\TeamsController@index')->name('teams');
Route::get('contact_us', 'FrontEnd\ContactUsController@index')->name('contact_us');
Route::get('services', 'FrontEnd\ServicesController@index')->name('services');
Route::get('terms-and-conditions', 'FrontEnd\TermsAndConditionController')->name('terms-and-conditions');
Route::get('about_us', 'FrontEnd\AboutUsController')->name('about_us');
Route::get('track-your-order', 'FrontEnd\TrackYourOrderController@index')->name('track-your-order');
Route::post('track-your-order-send', 'FrontEnd\TrackYourOrderController@send')->name('track-your-order-send');
// End Pages

/* ChatBOt Route */

});
Route::match(['get', 'post'], '/botman', 'ChatBoxController@enterRequest');
