<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Card;

class test extends Controller {
	private $html = "text/html";

    public function test() {
    	$cards = Card::all();

    	$response = response()->view('test', ['data' => $cards], 200);
    	$response->header("Content-Type", $this->html);

    	return $response;
    }
}
