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

        return $this->sendMessage("card", $card);
    }

    public function show($id) {
        $card = Card::find($id);

        return $this->sendMessage("card", $card);
    }

    public function update(Request $request, $id) {
        $card = Card::find($id);

        $card->name = $request->input('name');
        $card->expansion = $request->input('expansion');
        $card->number = $request->input('number');
        $card->rarity = $request->input('rarity');
        $card->src = $request->input('src');
        $card->save();

        return $this->sendMessage("card", $card);
    }

    public function destroy($id) {
        $card = Card::find($id);
        $card->delete();

        return $this->sendMessage("message", "The product with the id $card->id has successfully been deleted.");
    }

    private function sendMessage($key, $message) {
        return response()->json([
            'error' => false,
            $key => $message,
        ], 200);
    }
}
