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


Route::get('getProducts', 'ProductController@getProducts')->name('getProducts');
//Route::get('product/{slug}', 'ProductController@show')->name('product');
Route::get('create', 'ProductController@create')->name('create');
Route::post('store', 'ProductController@store')->name('store');
/*Route::get('edit/{id}', 'ProductController@edit')->name('edit');
Route::delete('delete/{id}', 'ProductController@destroy')->name('delete');
Route::post('update', 'ProductController@update')->name('update');*/


Auth::routes();
Route::get('/', 'OrderController@index');
Route::get('/products', 'HomeController@index')->name('products');
Route::get('/home', 'OrderController@index')->name('home');
Route::get('getOrders', 'OrderController@getOrders')->name('getOrders');
Route::get('showOrder/{id}', 'OrderController@show')->name('showOrder');
Route::get('getOrderById/{id}', 'OrderController@getOrderById')->name('getOrderById');
