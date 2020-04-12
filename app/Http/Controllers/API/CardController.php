<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Card;

class CardController extends Controller {
    public function index() {
        $card = Card::all();

        return $this->sendMessage("cards", $card);
    }

    public function store(Request $request) {
        $card = Card::create($request->all());

        //echo $request->title;

        return $this->sendMessage("card", $card);
    }

    public function show($id) {
        $card = Card::find($id);

        return $this->sendMessage("card", $card);
    }

    public function update(Request $request, $id) {
        $card = Card::find($id);

        $card->quantity = $this->getQuantity();
        $card->price_from = $this->getPriceFrom();
        $card->src = $request->input('src');
        $card->save();

        return $this->sendMessage("card", $card);
    }

    public function destroy($id) {
        $card = Card::find($id);
        $card->delete();

        return $this->sendMessage("message", "The card with the id $card->id has successfully been deleted.");
    }

    public function restore($id) {
        $card = Card::withTrashed()->find($id)->restore();
        return $this->sendMessage("message", "The card with the id $id has successfully been restored.");
    }

    private function sendMessage($key, $message) {
        return response()->json([
            'error' => false,
            $key => $message,
        ], 200);
    }

    public function test() {
        return response()->view('testing', ['cards' => Card::all()])->header("Accept", "application/json");
    }
}