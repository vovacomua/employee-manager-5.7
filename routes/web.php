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
Route::get('/treerebase', 'TreeController@treeRebase');

Route::get('/home/employees', 'EmployeeController@index');
Route::get('/home/employees/order', 'EmployeeController@order')->name('order');
Route::get('/home/employees/search', 'EmployeeController@search')->name('search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/home/employees', 'EmployeeController');
