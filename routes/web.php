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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('products', 'ProductController');

Route::resource('categories', 'CategoryController');
Route::resource('sub_categories', 'SubCategoryController');
// Route::get('product/search', 'ProductController@search_product_view')->name('product.search'); //normal search
Route::post('product/search', 'SearchController@search_product')->name('product.ajax_search'); // ajax search different way
Route::get('find/product', 'SearchController@get_product')->name('get.product'); 

// Route::get('/product/search', 'SearchController@live_search')->name('product_search.action'); // ajax seardh