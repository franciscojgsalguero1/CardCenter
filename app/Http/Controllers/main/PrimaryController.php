<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Card;

class PrimaryController extends Controller {
	private $html = "text/html";
    private $json = "javascript/json";

    public function view() {
    	$cards = Card::all();

    	$response = response()->view('view_cards', ['data' => $cards], 200);
    	$response->header("Content-Type", $this->html);

    	return $response;
    }

    public function add_cards() {
        return response()->view('add_cards', ['cards' => Card::all()]);
    }

    public function send() {
        return response()->view('send', ['cards' => Card::all()]);
    }

    public function test($id) {
        return response()->view('test', ['card' => Card::find($id)]);
    }
}