<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Card;

class Test extends Controller {
	private $html = "text/html";

    public function cards() {
    	$cards = Card::all();

    	$response = response()->view('test', ['data' => $cards], 200);
    	$response->header("Content-Type", $this->html);

    	return $response;
    }

    public function view() {
        return response()->view('testing', ['cards' => Card::all()]);
    }
}
