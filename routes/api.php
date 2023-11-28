<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(["namespace" => "Api"], function () {
    Route::post('login', 'AuthController@login');

});  
  
Route::group(['middleware' => ["auth:api"], "namespace" => "Api"], function () {

    Route::get('transactions', 'TransactionController@index')->middleware('can:read_transactions');
    Route::get('transactions/{id}', 'TransactionController@show')->middleware('can:read_transactions');
    Route::post('transactions', 'TransactionController@store')->middleware('can:create_transactions');

    Route::get('payments', 'PaymentController@index')->middleware('can:read_payments');
    Route::get('payments/{id}', 'PaymentController@show')->middleware('can:read_payments');
    Route::post('payments', 'PaymentController@store')->middleware('can:create_payments');

});