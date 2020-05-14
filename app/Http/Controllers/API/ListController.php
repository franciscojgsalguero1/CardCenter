<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CardList;

class ListController extends Controller {
    public function index() {
        $list = CardList::all();
    }

    public function store(Request $request) {
        $list = CardList::create($request->all());
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
