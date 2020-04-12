<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Card;

class CardController extends Controller {
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

        $card->quantity = $this->getQuantity();
        $card->price_from = $this->getPriceFrom();
        $card->src = $request->input('src');
        $card->save();    }

    public function destroy($id) {
        $card = Card::find($id);
        $card->delete();
    }

    public function restore($id) {
        $card = Card::withTrashed()->find($id)->restore();
    }

    public function test() {
        return response()->view('testing', ['cards' => Card::all()])->header("Accept", "application/json");
    }
}