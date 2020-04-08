<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CardList as List;

class ListController extends Controller {
    public function index() {
        $list = List::all();

        return $this->sendMessage("cards", $list);
    }

    public function store(Request $request) {
        $list = List::create($request->all());

        return $this->sendMessage("cards", $list);
    }

    public function show($id) {
        $list = List::find($id);

        return $this->sendMessage("cards", $list);
    }

    public function update(Request $request, $id) {
        $list = List::find($id);

        $list->seller = $request->input('seller');
        $list->language = $request->input('language');
        $list->price = $request->input('price');
        $list->quantity = $request->input('quantity');
        $list->condition = $request->input('condition');
        $list->comment = $request->input('comment');
        $list->fullArt = $request->input('fullArt');
        $list->foil = $request->input('foil');
        $list->signed = $request->input('signed');
        $list->uber = $request->input('uber');
        $list->playset = $request->input('playset');
        $list->src = $request->input('src');
        $list->save();

        return $this->sendMessage("cards", $list);
    }

    public function destroy($id) {
        $list = List::find($id);
        $list->delete();

        return $this->sendMessage("message", "The card with the id $list->id has successfully been deleted.");
    }

    public function restore($id) {
        $list = List::withTrashed()->find($id)->restore();
        return $this->sendMessage("message", "The card with the id $id has successfully been restored.");
    }

    private function sendMessage($key, $message) {
        return response()->json([
            'error' => false,
            $key => $message,
        ], 200);
    }
}
