<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Final */
Route::group(["namespace" => "API"], function() {
	Route::apiResource('cards', 'CardController');
	Route::post('cards/store/', 'CardController@store');
	Route::get('cards/restore/{id}', 'CardController@restore');
});

Route::group(["namespace" => "API"], function() {
	Route::apiResource('transactions', 'TransactionsController');
	Route::get('transactions/restore/{id}', 'TransactionsController@restore');
});

Route::group(["namespace" => "API"], function() {
	Route::apiResource('clists', 'TransactionsController');
	Route::get('clists/restore/{id}', 'TransactionsController@restore');
});