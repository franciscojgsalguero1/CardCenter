<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Final */
Route::group(["namespace" => "main"], function() {
	Route::apiResource('cards', 'CardController');
	Route::get('cards/restore/{id}', 'CardController@restore');
});

Route::group(["namespace" => "main"], function() {
	Route::apiResource('transactions', 'TransactionsController');
	Route::get('transactions/restore/{id}', 'TransactionsController@restore');
	Route::get('transactions/updateConfirm/{id}' , 'TransactionsController@updateConfirm');
});

Route::group(["namespace" => "main"], function() {
	Route::apiResource('clist', 'ListController');
	Route::get('clist/restore/{id}', 'ListController@restore');
});
