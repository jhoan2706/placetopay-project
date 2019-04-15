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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('payment/create', 'PaymentController@create')->name('create_payment_form');
Route::post('payment/store', 'PaymentController@store')->name('payment.store');

Route::get('transactions', 'TransactionController@index')->name('show_transactions');
Route::get('transactions/{reference}', 'TransactionController@show')->name('show_transaction_detail');