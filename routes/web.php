<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/view/', 'main\PrimaryController@view');

/* Final */
Auth::routes();

/* Cards */
Route::get('/add/', "main\PrimaryController@add_cards");
Route::get('/view/{id}/', "main\PrimaryController@read_one");
Route::get('/delete/{id}/', "main\PrimaryController@delete");

/* Card List */


/* Transactions */