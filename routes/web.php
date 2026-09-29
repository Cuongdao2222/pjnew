<?php

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

Route::get('/', 'BlogController@index');
Route::get('/category', 'BlogController@category');
Route::get('/detail/{slug?}', 'BlogController@detail');
Route::get('/cart', 'BlogController@viewCart');
Route::get('/suggest', 'BlogController@suggest');
Route::post('/add-to-cart', 'BlogController@addToCart');
Route::get('/get-cart-count', 'BlogController@getCartCount');
