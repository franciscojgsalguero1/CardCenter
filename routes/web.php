<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/view/', 'main\CardController@view');
Route::get('/view/{juego}', 'main\CardController@viewjuego');
/* Final */
Auth::routes();

/* Cards */
Route::get('/add/', "main\CardController@add_cards");

/* Card List */
Route::get('/view/{id}/', "main\ListController@read_one");
Route::get('/delete/{id}/', "main\ListController@deleteList");
route::get('/prueba/{id}/', "main\ListController@test");

/* Transactions */
Route::get('/cart_view/', "main\TransactionsController@cart_view");
route::get('/', "main\CardController@main");
route::get('/{id}', "main\CardController@mainGames");

/* User */
Route::get('/changePassword', "HomeController@showChangePasswordForm");
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
