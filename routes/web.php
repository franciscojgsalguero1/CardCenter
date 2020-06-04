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
Route::get('/', "main\CardController@main");
Route::get('/{id}', "main\CardController@anotherGame");
Route::get('/transaction_delete/{id}' ,"main\TransactionsController@deleteTransaction")->name('compra');
Route::get('/transaction_add/{cart}/{cantidad}/{transaccion}', "main\TransactionsController@add");


/* User */
Route::get('/changePassword', "HomeController@showChangePasswordForm");
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

/* Carrito */

Route::bind('cart', function($id){
	return App\Card::where('id', $id)->first();
});

Route::get('cart/show', [
	'as' => 'cart-show',
	'uses' => 'CartController@show'
	//'uses' => 'HomeController@session'
]);

Route::get('cart/add/{product}', [
	'as' => 'cart-add',
	'uses' => 'CartController@add']
);