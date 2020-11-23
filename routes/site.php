<?php
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Setting;
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
Route::post('/chat/upload/photots/{id}', 'FrontEnd\ChatController@sendMessage')->name('sendMessage')->middleware('image-sanitize');

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
 /* FrontEnd route */


Auth::routes(['verify' => true]);

// login with socialite
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login_with_social');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// Home page
Route::get('/', 'HomeController@index')->name('home');

// Single product page
Route::get('/product/{slug}', 'FrontEnd\ProductController@show')->name('show_product');

//  ajax request to get variations data
Route::post('/get/variations/data', 'FrontEnd\ProductController@get_data')->name('get_data');

// Category page
Route::get('/category/{slug}', 'FrontEnd\ShopController@index')->name('show_category');

// Super deal page (discount page)
Route::get('/super-deal', 'FrontEnd\SuperDealController@index')->name('show_superdeal');

// Cart page
Route::get('/cart', function () {
    return view('FrontEnd.cart-page');
})->name('show_cart');

// checkout page
Route::get('/checkout', function (Request $request) {
    $payment = '';
    if($request->payment === 'stripe') {
        $payment = 'stripe';
    } elseif($request->payment === 'paypal') {
        $payment = 'paypal';
    }
    return view('FrontEnd.checkout', ['payment' => $payment]);
})->name('show_checkout');

// Payment
Route::post('/payment/{payment}','FrontEnd\payment\BillingController@payment')->name('payment');

Route::get('cancel', 'FrontEnd\BillingController@cancel')->name('payment.cancel');

Route::get('payment/success', 'FrontEnd\payment\BillingController@success')->name('payment.success');

Route::get('payment/successfully/', function () {
    if(session()->get('order') !== null) {
        return view('FrontEnd.success_page',['order' => session()->get('order')[0]]);
    } else {
        return redirect()->route('shop');
    }
})->name('success_page');

/* Route::post('/checkout/store','FrontEnd\BillingController@store')->name('checkout_store');
 */

// Contact Us page
Route::get('/contact_us','FrontEnd\ContactUsController@index')->name('contact_us');
// Contact Us store form
Route::post('/contact_us','FrontEnd\ContactUsController@store')->name('contact_us_store');


// Compage page
Route::get('/compare', function () {
    return view('FrontEnd.compare');
})->name('show_compare');

// Wishlists page
Route::get('/wishlists', function () {
    return view('FrontEnd.wishlists');
})->name('show_wishlists')->middleware('auth');

// Shop Page
Route::get('/shop', function () {
    $setting             = Setting::latest('id')->first();

    SEOTools::setTitle($setting?$setting->sitename:config('app.name'));
    SEOTools::setDescription($setting?$setting->meta_description:config('app.name'));
    SEOTools::opengraph()->setUrl(url('/'));
    SEOTools::setCanonical(url('/'));
    SEOTools::opengraph()->addProperty('type', 'site');
    SEOTools::twitter()->setSite($setting?$setting->twitter:'');
    SEOTools::jsonLd()->addImage($setting?\Storage::url($setting->image):'');

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

 // Tags Page
Route::get('/tag/{slug}','FrontEnd\TagController@index')->name('tags');

// Brand Page
Route::get('/brand/{slug}','FrontEnd\BrandController@index')->name('brand');

// Seller Application page
Route::get('/seller/app', 'FrontEnd\SellerAppController@index')->middleware('verified')->name('seller_app');
// Seller Application store form
Route::post('/seller/app', 'FrontEnd\SellerAppController@store')->middleware('verified')->name('store_app')->middleware('image-sanitize');

// Seller Dashboard
Route::get('/seller/dashboard','FrontEnd\SellerController@index')->middleware(['verified', 'store_session'])->name('seller_dashboard');
// Seller update store profile
Route::get('/seller/profile','FrontEnd\SellerProfileController@index')->middleware(['verified', 'store_session'])->name('store_profile');

Route::put('/seller/profile/{id}','FrontEnd\SellerProfileController@update')->middleware(['verified', 'store_session'])->name('store_profile_update');
// Seller products
Route::get('/seller/products','FrontEnd\SellerController@products')->middleware(['verified', 'store_session'])->name('seller_frontend_products');

// Seller products create page
Route::get('/seller/products/create','FrontEnd\SellerController@create')->middleware(['verified', 'store_session'])->name('seller_frontend_products_create');
// Seller products store
Route::post('/seller/products/store','FrontEnd\SellerController@store')->middleware(['verified', 'store_session'])->name('seller_frontend_products_store');

// Seller products edit page
Route::get('/seller/products/edit/{slug}','FrontEnd\SellerController@edit')->middleware(['verified', 'store_session'])->name('seller_frontend_products_edit');
// Seller products update
Route::put('/seller/products/edit/{slug}','FrontEnd\SellerController@update')->middleware(['verified', 'store_session'])->name('seller_frontend_products_update');

// Seller products delete
Route::delete('/seller/products/delete/{slug}','FrontEnd\SellerController@destroy')->middleware(['verified', 'store_session'])->name('seller_frontend_products_delete');

// Seller products delete all
Route::delete('/seller/products/destroy/all', 'FrontEnd\SellerController@destory_all')->middleware(['verified', 'store_session'])->name('seller_frontend_products_destroy_all');


// Seller products variations page
Route::get('/seller/products/variations/{slug}', 'FrontEnd\SellerController@variations')->middleware(['verified', 'store_session'])->name('seller_frontend_products_variations');

// Seller products variations store
Route::post('/seller/products/variations/{slug}', 'FrontEnd\SellerController@variations_store')->middleware(['verified', 'store_session'])->name('seller_frontend_products_variations_store');

// Seller products variations update
Route::post('/seller/products/variations/update/{slug}', 'FrontEnd\SellerController@variation_update')->middleware(['verified', 'store_session'])->name('seller_frontend_products_variations_update');

// Seller products accessories page
Route::get('/seller/products/accessories/{slug}', 'FrontEnd\SellerController@accessories')->middleware(['verified', 'store_session'])->name('seller_frontend_products_accessories');

// Seller orders page
Route::get('/seller/orders', 'FrontEnd\SellerController@orders')->middleware(['verified', 'store_session'])->name('seller_frontend_orders');

// Seller show order page
Route::get('/seller/orders/show/{id}', 'FrontEnd\SellerController@orders_show')->middleware(['verified', 'store_session'])->name('seller_frontend_orders_show');

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

// Event page
Route::get('/event/{slug}', 'FrontEnd\EventController@cms_show')->name('cms_show');

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

 // Seller Discount create page
 Route::get('/seller/discount/{id}', 'FrontEnd\DiscountController@create')->middleware('verified')->name('seller_add_discount');

 // Seller Discount store
 Route::post('/seller/discount/store/{id}', 'FrontEnd\DiscountController@store')->middleware('verified')->name('seller_discount_store');

 // Seller Discount edit page
 Route::get('/seller/discount/edit/{id}', 'FrontEnd\DiscountController@edit')->middleware('verified')->name('seller_discount_edit');

 // Seller Discount update
Route::post('/seller/discount/update/{id}', 'FrontEnd\DiscountController@update')->middleware('verified')->name('seller_discount_update');

/* End seller Discount */

//
Route::get('/search', 'HomeController@search')->middleware('ChangeCountry')->name('search');
Route::get('/invoice/{id}', 'FrontEnd\SellerController@export_invoice')->name('export_invoice');
Route::get('/seller/store/{slug}', 'FrontEnd\SellerProfileController@show_seller')->name('show_seller');


/* Chat (Seller & Customer) */
Route::get('/chat', 'FrontEnd\ChatController@seller')
->middleware(['auth','verified'])->name('show_chat');
/* Route::get('/chat/asd', 'FrontEnd\ChatController@chat')->middleware(['auth','verified'])->name('chat');
 */
// Profile Page
Route::get('/profile','FrontEnd\ProfileController@index')->middleware('verified')->name('profile');
Route::put('/profile/update','FrontEnd\ProfileController@update')->middleware('verified')->name('user_profile.update')->middleware('image-sanitize');;
Route::put('/profile/password','FrontEnd\ProfileController@password')->middleware('verified')->name('user_profile.password');
Route::get('/profile/order/{id}','FrontEnd\ProfileController@order')->middleware('verified')->name('profile.order.show');





// Start Pages
Route::get('teams', 'FrontEnd\TeamsController@index')->name('teams');
Route::get('contact_us', 'FrontEnd\ContactUsController@index')->name('contact_us');
Route::get('services', 'FrontEnd\ServicesController@index')->name('services');
Route::get('terms-and-conditions', 'FrontEnd\TermsAndConditionController')->name('terms-and-conditions');
Route::get('about_us', 'FrontEnd\AboutUsController')->name('about_us');
Route::get('blogs', 'FrontEnd\BlogsController@index')->name('blogs');
Route::get('blogs/search', 'FrontEnd\BlogsController@blogs_search')->name('blogs_search');
Route::get('blogs/tags/{slug}', 'FrontEnd\BlogsController@blogs_tags')->name('blogs_tags');
Route::get('blog/{slug}', 'FrontEnd\BlogController')->name('blog');
Route::get('track-your-order', 'FrontEnd\TrackYourOrderController@index')->name('track-your-order');
Route::post('track-your-order-send', 'FrontEnd\TrackYourOrderController@send')->name('track-your-order-send');
// End Pages

/* ChatBOt Route */

Route::get('testing', 'TestController@index');
});
Route::match(['get', 'post'], '/botman', 'ChatBoxController@enterRequest');
