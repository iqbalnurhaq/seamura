<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index')->name('home');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');
Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::get('/search', 'SearchController@index')->name('search');
// Route::post('/search', 'SearchController@searchProducts')->name('search-products');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::prefix('admin')
->namespace('Admin')
->middleware(['auth', 'admin'])
->group(function() {
    Route::get('dashboard', 'DashboardController@index')->name('admin-dashboard');
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
    Route::resource('cabang', 'CabangController');
    Route::resource('ongkir', 'OngkirController');
    Route::resource('order', 'OrderController');
});

Auth::routes();