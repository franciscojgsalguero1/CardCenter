<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Card;

class CardController extends Controller {
    private $html = "text/html";
    private $json = "javascript/json";
    
    public function index() {
        $card = Card::all();
    }

    public function store(Request $request) {
        $card = Card::create($request->all());
    }

    public function show($id) {
        $card = Card::find($id);
    }

    public function update(Request $request, $id) {
        $card = Card::find($id);
        $card->save();
    }

    public function destroy($id) {
        $card = Card::find($id);
        $card->delete();
    }

    public function restore($id) {
        $card = Card::withTrashed()->find($id)->restore();
    }

    public function view() {
        $cards = Card::all();

        $response = response()->view('view_cards', ['data' => $cards], 200);
        $response->header("Content-Type", $this->html);

        return $response;
    }

    public function add_cards() {
        return response()->view('add_cards', ['cards' => Card::all()]);
    }
}