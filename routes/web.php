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
Route::get('/cart_view/{user}', "main\TransactionsController@transactionToBuy");
Route::get('/', "main\CardController@main")->name('main');
Route::get('/{id}', "main\CardController@anotherGame");
Route::get('/transaction_delete/{id}/{count}' ,"main\TransactionsController@deleteTransaction")->name('compra');
Route::get('/transaction_add/{cart}/{cantidad}/{transaccion}', "main\TransactionsController@confirmBuy");
Route::get('/confirm/button_buy_all/{name}', "main\TransactionsController@buyAllItems");


/* User */
Route::get('/user/changePassword', "HomeController@showChangePasswordForm");
Route::post('/user/changePassword','HomeController@changePassword')->name('changePassword');
Route::get('/user/recoverPassword', "RecoverPasswordController@showRecoverPasswordForm");
Route::post('/user/recoverPassword', "RecoverPasswordController@recoverPassword")->name('recoverPassword');
Route::get('/user/updateAccountDetails', "HomeController@showUpdateAccountDetailsForm");
Route::post('/user/updateAccountDetails', "HomeController@updateAccountDetails")->name('updateAccountDetails');
Route::get('/user/showDetails', "HomeController@showDetails")->name("showDetails");
Route::get('/user/purchases', "HomeController@purchases")->name('purchases');
Route::get('/user/sales', "HomeController@sales")->name('sales');