<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CardList;
use App\Card;

class ListController extends Controller {
    public function index() {
        $list = CardList::all();
    }

    public function store(Request $request) {
        $list = CardList::create($request->all());

        $this->updateCardQuantity($request);
        $this->updateCardPriceFrom($request);
    }

    private function updateCardQuantity(Request $request) {
        $name = $request->input('name');
        $new_qtty = $request->input('quantity');

        $id = Card::where('name', $name)->get('id');
        $card = Card::find($id[0]['id']);
        $card->quantity = $card->quantity + $new_qtty;
        $card->save();
    }

    private function updateCardPriceFrom(Request $request) {
        $name = $request->input('name');
        $new_price = $request->input('price');

        $id = Card::where('name', $name)->get('id');
        $card = Card::find($id[0]['id']);
        if ($card->price_from !== 0.00 && $card->price_from > $new_price) {
            $card->price_from = $new_price;
            $card->save();
        }
    }

    public function show($id) {
        $list = CardList::find($id);
    }

    public function update(Request $request, $id) {
        $list = CardList::find($id);

        $list->seller = $this->getSeller();
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
        $list->save();
    }

    public function destroy($id) {
        $list = CardList::find($id);
        $list->delete();
    }

    public function restore($id) {
        $list = CardList::withTrashed()->find($id)->restore();
    }
}
