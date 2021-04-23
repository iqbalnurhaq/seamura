<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products/{slug}', 'API\ProductController@products')->name('api-products');
Route::get('products_home', 'API\ProductController@productsHome')->name('api-getproductshome');
Route::get('products_cari/{name}', 'API\ProductController@cariProducts')->name('api-products-cari');
Route::get('regencies', 'API\LocationController@regencies')->name('api-regencies');
Route::get('districts/{regencies_id}', 'API\LocationController@districts')->name('api-districts');
Route::get('villages/{districts_id}', 'API\LocationController@villages')->name('api-villages');
Route::get('open_branchs', 'API\LocationController@openCabang')->name('api-open-branchs');
Route::post('open_branchs', 'API\LocationController@addCabang')->name('api-add-branchs');
Route::delete('open_branchs/{id}', 'API\LocationController@deleteCabang')->name('api-delete-branchs');
// Route::delete('open_branchs', 'API\LocationController@openCabang')->name('api-open-branchs');
Route::get('branchs', 'API\LocationController@getBranchs')->name('api-branchs');
Route::post('add_ongkir', 'API\LocationController@addOngkir')->name('api-add-ongkir');
Route::get('districts-ongkir/{regencies_id}', 'API\LocationController@districtsOngkir')->name('api-districts-ongkir');
Route::get('get_ongkir/{districts_id}', 'API\LocationController@getOngkir')->name('api-get-ongkir');

Route::post('order', 'API\ProductController@order')->name('api-order');