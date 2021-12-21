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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('/products', 'ProductController');

Route::resource('/stocks', 'StockController');

Route::resource('/clients', 'ClientController');

Route::resource('/sell', 'SellController');

Route::post('/selldetails/store', 'SelldetailsController@store')->name('selldetails.store');

Route::get('/selldetails/{selldetail}', 'SelldetailsController@show')->name('selldetails.show');

Route::put('/selldetails/{selldetail}', 'SelldetailsController@update')->name('selldetails.update');

Route::get('/sell/payment/{sell}', 'PaymentController@sellIndex');

Route::resource('/sell/payment', 'PaymentController');
