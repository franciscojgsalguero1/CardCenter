<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Card;

class CartController extends Controller
{
	public function __contruct()
	{
		if(!\Session::has('cart')) \Session::put('cart', array());
	}

	// show cart
	public function show(Request $request)
	{
		//echo("hola mundo");
		//session(['Maria'=>'Estudiante']);
		//return $request->session()->all();
		return \Session::get('cart');
	}
	// Add item
	public function add(Card $card)
	{
		$cart = \Session::get('cart');
		$card->quantity = 1;
		$cart[$card->id] = $card;
		\Session::put('cart', $cart);

		return redirect()->route('cart-show');
	}

	// Delete item

	// Update item

	// Trash cart

	// Total

}
