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

Route::get('/', 'TreeController@index');
Route::get('/tree', 'TreeController@tree');

Route::get('/home/list', 'ListController@index');
Route::get('/home/list/order', 'ListController@order')->name('order');
Route::get('/home/list/search', 'ListController@search')->name('search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
