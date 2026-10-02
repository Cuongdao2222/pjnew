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
Route::get('/category/{slug?}', 'BlogController@category');
Route::get('/detail/{slug?}', 'BlogController@detail');
Route::get('/cart', 'BlogController@viewCart');
Route::get('/suggest', 'BlogController@suggest');
Route::post('/add-to-cart', 'BlogController@addToCart');
Route::get('/get-cart-count', 'BlogController@getCartCount');

Route::group(['prefix' => 'backend'], function () {
    Route::get('/products', 'BackendController@index');
    Route::get('/product/create', 'BackendController@create');
    Route::post('/product/store', 'BackendController@store');
    Route::get('/product/{id}/edit', 'BackendController@edit');
    Route::put('/product/{id}', 'BackendController@update');
    Route::delete('/product/{id}', 'BackendController@destroy');

    Route::get('/categories', 'BackendController@categoriesIndex');
    Route::get('/category/create', 'BackendController@categoryCreate');
    Route::post('/category/store', 'BackendController@categoryStore');
    Route::delete('/category/{id}', 'BackendController@categoryDestroy');
});
