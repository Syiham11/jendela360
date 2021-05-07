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


Route::get('/', 'MasterController@masuk');
Route::post('/validasilogin', 'NativeauthController@validasilogin');
Route::get('/logout', 'NativeauthController@logout');
Route::get('/welcome', 'MasterController@index');
// this route car
Route::resource('/car', 'CarController');
Route::post('car/update', 'CarController@update')->name('car.update');
Route::get('car/destroy/{id}', 'CarController@destroy');
// this route sale
Route::resource('/sale', 'SaleController');
