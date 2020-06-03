<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});

Auth::routes();

/* Cards */
Route::get('/add/', "main\CardController@add_cards");
Route::get('/view_game/{juego}', 'main\CardController@viewjuego');
Route::get('/view/', 'main\CardController@view');

/* Card List */
Route::get('/view/{id}/', "main\ListController@read_one");
Route::get('/delete/{id}/', "main\ListController@deleteList");

/* Transactions */
Route::get('/cart_view/', "main\TransactionsController@cart_view");
Route::get('/', "main\CardController@main");
Route::get('/{id}', "main\CardController@anotherGame");

/* User */
Route::get('/changePassword', "HomeController@showChangePasswordForm");
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
