<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});

Auth::routes();

/* Cards */
Route::get('/add/', "main\CardController@addCards");
Route::get('/viewGame/{juego}', 'main\CardController@viewGame');
Route::get('/view/', 'main\CardController@view');

/* Card List */
Route::get('/view/{id}/', "main\ListController@readOne");
Route::get('/delete/{id}/', "main\ListController@deleteList");

/* Transactions */
Route::get('/cartView/{user}', "main\TransactionsController@transactionToBuy");
Route::get('/', "main\CardController@main")->name('main');
Route::get('/{id}', "main\CardController@anotherGame");
Route::get('/transaction_delete/{id}/{count}' ,"main\TransactionsController@deleteTransaction")->name('compra');
Route::get('/transaction_add/{cart}/{cantidad}/{transaccion}', "main\TransactionsController@confirmBuy");
Route::get('/confirm/button_buy_all/{name}', "main\TransactionsController@buyAllItems");


/* User */ 
Route::get('/user/changePassword', "main\UserController@showChangePasswordForm");
Route::post('/user/changePassword','main\UserController@changePassword')->name('changePassword');
Route::get('/user/recoverPassword', "main\UserController@showRecoverPasswordForm");
Route::post('/user/recoverPassword', "main\UserController@recoverPassword")->name('recoverPassword');
Route::get('/user/updateAccountDetails', "main\UserController@showUpdateAccountDetailsForm");
Route::post('/user/updateAccountDetails', "main\UserController@updateAccountDetails")->name('updateAccountDetails');
Route::get('/user/showDetails', "main\UserController@showDetails")->name("showDetails");
Route::get('/user/purchases', "main\UserController@purchases")->name('purchases');
Route::get('/user/sales', "main\UserController@sales")->name('sales');
Route::get('/user/userList', "main\UserController@userList")->name('userList');
Route::get('/user/delete/{id}', "main\UserController@deleteUser");