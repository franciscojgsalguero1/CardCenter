<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Card;
use App\CardList;

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

    public function read_one($id) {
        $name = Card::find($id)->name;

        return response()->view('read_one', [
            'card' => Card::find($id),
            'clist' => CardList::where('name', $name)->get()
        ]);
    }

    public function delete($id) {
        $card = Card::find($id);
        $card->delete();
    }
}
