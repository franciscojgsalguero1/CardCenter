<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Final */
Route::group(["namespace" => "API"], function() {
	Route::apiResource('cards', 'CardController');
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