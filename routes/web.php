<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ["auth"], "namespace" => "Web"], function () {

    Route::get('transactions', 'TransactionController@index')->middleware('can:read_transactions');
    Route::get('transactions/{id}', 'TransactionController@show')->middleware('can:read_transactions');
    Route::post('transactions', 'TransactionController@store')->middleware('can:create_transactions');

    Route::get('payments', 'PaymentController@index')->middleware('can:read_payments');
    Route::get('payments/{id}', 'PaymentController@show')->middleware('can:read_payments');
    Route::post('payments', 'PaymentController@store')->middleware('can:create_payments');

});