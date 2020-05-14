<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/view', 'main\PrimaryController@view');
Route::get('/add', "main\PrimaryController@add_cards");
Route::get('/view/{id}', "main\PrimaryController@read_one");
Route::get('/delete/{id}', "main\PrimaryController@delete");


/* Final */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');