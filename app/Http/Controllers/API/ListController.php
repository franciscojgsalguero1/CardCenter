<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CardList as List;

class ListController extends Controller {
    public function index() {
        $list = List::all();
    }

    public function store(Request $request) {
        $list = List::create($request->all());
    }

    public function show($id) {
        $list = List::find($id);
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
    }

    public function destroy($id) {
        $list = List::find($id);
        $list->delete();
    }

    public function restore($id) {
        $list = List::withTrashed()->find($id)->restore();
    }
}
