<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/view', 'main\PrimaryController@view');
Route::get('/add', "main\PrimaryController@cards");


/* Final */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');