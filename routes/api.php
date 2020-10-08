<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
Route::group([
    'middleware' => ['api']

], function ($router) {

Route::get('{locale}/products', 'Api\ProductController@index')->where('locale', '[a-zA-Z]{2}');
Route::get('{locale}/products/{slug}', 'Api\ProductController@show')->where('locale', '[a-zA-Z]{2}');
Route::post('products/store','Api\ProductController@store');
Route::put('products/update/{slug}','Api\ProductController@update');
Route::delete('products/delete/{slug}','Api\ProductController@destroy');
Route::post('products/multi_delete','Api\ProductController@destory_all');


Route::get('{locale}/shippings', 'Api\ShippingController@index')->where('locale', '[a-zA-Z]{2}');
Route::get('{locale}/shippings/{id}', 'Api\ShippingController@show')->where('locale', '[a-zA-Z]{2}');

Route::get('{locale}/attributes', 'Api\ShippingController@index_attributes')->where('locale', '[a-zA-Z]{2}');
Route::get('{locale}/attributes/{id}', 'Api\ShippingController@show_attributes')->where('locale', '[a-zA-Z]{2}');

Route::get('{locale}/posts', 'Api\PostController@index')->where('locale', '[a-zA-Z]{2}');
Route::get('{locale}/posts/{slug}', 'Api\PostController@show')->where('locale', '[a-zA-Z]{2}');


Route::get('{locale}/countries', 'Api\CountryController@index')->where('locale', '[a-zA-Z]{2}');
Route::get('{locale}/countries/{id}', 'Api\CountryController@show')->where('locale', '[a-zA-Z]{2}');

Route::get('{locale}/categories', 'Api\CountryController@category_index')->where('locale', '[a-zA-Z]{2}');
Route::get('{locale}/categories/{slug}', 'Api\CountryController@category_show')->where('locale', '[a-zA-Z]{2}');

Route::get('{locale}/brands', 'Api\CountryController@brands_index')->where('locale', '[a-zA-Z]{2}');
Route::get('{locale}/brands/{slug}', 'Api\CountryController@brands_show')->where('locale', '[a-zA-Z]{2}');


Route::get('{locale}/adz/', 'Api\CountryController@adz_index')->where('locale', '[a-zA-Z]{2}');
Route::get('{locale}/adz/{slug}', 'Api\CountryController@adz_show')->where('locale', '[a-zA-Z]{2}');

Route::get('{locale}/cms/', 'Api\CountryController@cms_index')->where('locale', '[a-zA-Z]{2}');
Route::get('{locale}/cms/{slug}', 'Api\CountryController@cms_show')->where('locale', '[a-zA-Z]{2}');


Route::get('/adz', 'Api\AdzController@index');
Route::get('/adz/{slug}', 'Api\AdzController@show');


Route::get('/ourworks', 'Api\OurworkController@index');
Route::get('/ourworks/{id}', 'Api\OurworkController@show');


Route::get('/payments', 'Api\PaymentController@index');
Route::get('/payments/{id}', 'Api\PaymentController@show');


Route::get('/sliders', 'Api\SliderController@index');
Route::get('/sliders/{id}', 'Api\SliderController@show');


Route::get('/teams', 'Api\TeamController@index');
Route::get('/teams/{id}', 'Api\TeamController@show');


Route::get('/testimonials', 'Api\TestimonialController@index');
Route::get('/testimonials/{id}', 'Api\TestimonialController@show');


Route::get('{locale}/settings', 'Api\SettingController@index')->where('locale', '[a-zA-Z]{2}');


Route::post('contact-us', 'Api\ContactUsController@store');


Route::post('coupons/{code}', 'Api\CouponController@check');
//->where('code', '[A-Za-z]+');


//Route::get('coupons/{id}', 'Api\UserController@show');

});
