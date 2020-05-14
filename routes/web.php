<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/view', 'main\PrimaryController@view');
Route::get('/add', "main\PrimaryController@add_cards");
Route::get('/send', "main\PrimaryController@send");
Route::get('/test/{id}', "main\PrimaryController@test");


/* Final */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');