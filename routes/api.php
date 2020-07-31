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

    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => ['api']

], function ($router) {

Route::get('products', 'Api\ProductController@index');
Route::get('products/{slug}', 'Api\ProductController@show');
Route::post('products/store','Api\ProductController@store');
Route::put('products/update/{slug}','Api\ProductController@update');
Route::delete('products/delete/{slug}','Api\SellerController@destroy');


Route::get('shippings', 'Api\ShippingController@index');
Route::get('shippings/{id}', 'Api\ShippingController@show');

Route::get('attributes', 'Api\ShippingController@index_attributes');
Route::get('attributes/{id}', 'Api\ShippingController@show_attributes');

Route::get('posts', 'Api\PostController@index');
Route::get('posts/{slug}', 'Api\PostController@show');
Route::get('countries', 'Api\CountryController@index');
Route::get('countries/{id}', 'Api\CountryController@show');

Route::get('categories', 'Api\CountryController@category_index');
Route::get('categories/{slug}', 'Api\CountryController@category_show');

Route::get('brands', 'Api\CountryController@brands_index');
Route::get('brands/{slug}', 'Api\CountryController@brands_show');

Route::get('users/{id}', 'Api\UserController@show');

});
