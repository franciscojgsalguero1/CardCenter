<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/view/', 'main\CardController@view');

/* Final */
Auth::routes();

/* Cards */
Route::get('/add/', "main\CardController@add_cards");

/* Card List */
Route::get('/view/{id}/', "main\ListController@read_one");
Route::get('/delete/{id}/', "main\ListController@deleteList");

/* Transactions */
Route::get('/view_buy/{name}/', "main\TransactionsController@test");