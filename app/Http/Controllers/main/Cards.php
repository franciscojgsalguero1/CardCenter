<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Card;

class Cards extends Controller {
	private $json = "application/json";

    public function test() {
    	$cards = Card::all();

    	$response = response()->view('test', ['data' => $cards], 200);
    	$response->header("Content-Type", "text/html");
    	return $response;
    }
}
