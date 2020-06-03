<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Card;
use App\CardList;

class ListController extends Controller {

    /*
    * CRUD
    */

    public function index() {
        $list = CardList::all();
    }

    public function store(Request $request) {
        $list = CardList::create($request->all());
        $name = $request->input('name');
        $id = Card::where('name', $name)->get('id');
        $card = Card::find($id[0]['id']);

        $this->updateCardQuantity($name, $card);
        $this->updateCardPriceFrom($name, $card);

        return redirect()->action('main\ListController@read_one', ['id' => $card]);
    }

    private function updateCardQuantity($name, $card) {
        $total = 0;
        $list = CardList::where('name', $name)->get('quantity');

        foreach ($list as $item) {
            $total = $total + $item->quantity;
        }

        $card->quantity = $total;
        $card->save();
    }

    private function updateCardPriceFrom($name, $card) {
        $prices = array();
        $list = CardList::where('name', $name)->get();

        foreach ($list as $item) {
            array_push($prices, $item->price);
        }

        sort($prices);
        $card->price_from = $prices[0];
        $card->save();
    }

    public function show($id) {
        $list = CardList::find($id);
    }

    public function update(Request $request, $id) {
        $list = CardList::find($id);
        $name = CardList::find($id)->name;
        $list->language = $request->input('language');
        $list->price = $request->input('price');
        $list->quantity = $request->input('quantity');
        $list->condition = $request->input('condition');
        $list->comment = $request->input('comment');
        if ($request->input('fullArt') == "") {
            $list->fullArt = 0;
        } else {
            $list->fullArt = 1;
        }
        if ($request->input('foil') == "") {
            $list->foil = 0;
        } else {
            $list->foil = 1;
        }
        if ($request->input('signed') == "") {
            $list->signed = 0;
        } else {
            $list->signed = 1;
        }
        if ($request->input('uber') == "") {
            $list->uber = 0;
        } else {
            $list->uber = 1;
        }
        if ($request->input('playset') == "") {
            $list->playset = 0;
        } else {
            $list->playset = 1;
        }
        $list->save();
        $id = Card::where('name', $name)->get('id');
        $card = Card::find($id[0]['id']);

        $this->updateCardQuantity($request->input('name'), $card);
        $this->updateCardPriceFrom($request->input('name'), $card);

        return redirect()->action('main\ListController@read_one', ['id' => $card]);
    }

    public function destroy($id) {
        $list = CardList::find($id);
        $list->delete();
    }

    public function restore($id) {
        $list = CardList::withTrashed()->find($id)->restore();
    }

    /*
    * Controller Methods
    */

    public function read_one($id) {
        $name = Card::find($id)->name;

        return response()->view('read_one', [
            'card' => Card::find($id),
            'clist' => CardList::where('name', $name)->get()
        ]);
    }

    public function deleteList($id) {
        $card = CardList::find($id);
        $name = CardList::find($id)->name;
        $card->delete();
        $id = Card::where('name', $name)->get('id');
        $card = Card::find($id[0]['id']);

        $this->updateCardQuantity($name, $card);
        $this->updateCardPriceFrom($name, $card);

        return redirect()->action('main\ListController@read_one', ['id' => $card]);
    }
}