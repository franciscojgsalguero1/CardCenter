<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Card;
use App\CardList;

class CardController extends Controller {
    private $html = "text/html";

    /*
    * CRUD
    */
    
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

    /*
    * Controller Methods
    */

    public function view() {
        $cards = Card::all();

        $response = response()->view('viewCards', ['data' => $cards], 200);
        $response->header("Content-Type", $this->html);

        return $response;
    }

    public function viewGame($game) {
        $cards = Card::all()->where('game', $game);

        $response = response()->view('viewCards', ['data' => $cards], 200);
        $response->header("Content-Type", $this->html);

        return $response;
    }

    public function addCards() {
        return response()->view('addCards', ['cards' => Card::all()]);
    }
    
    public function main() {
        $output = [];
        $card = Card::all();
        $sale = CardList::all();
        foreach ($sale as $nombre => $valor) {
            foreach ($card as $nombre => $value) {
                if ($valor['name'] == $value['name']) {
                    if ($value['game'] == 'Force of Will'){
                        array_push($output, $valor);
                    }
                }
            }
        }
        return response()->view('main', [
            'first_cards' => Card::all()->where('game', 'Force of Will')->sortBy('updated_at')->take(10),
            'cardlist' => $output,
            'all_cards' => Card::all() 
        ]); 
    }

    public function anotherGame($id) {
        $output = [];
        $card = Card::all();
        $sale = CardList::all();
        foreach ($sale as $nombre => $valor) {
            foreach ($card as $nombre => $value) {
                if ($valor['name'] == $value['name']) {
                    if ($value['game'] == $id){
                        array_push($output, $valor);
                    }
                }
            }
        }
        return response()->view('main', [
            'first_cards' => Card::all()->where('game',$id)->sortBy('updated_at')->take(10),
            'cardlist' => $output,
            'all_cards' => Card::all(),
            'id' => $id
        ]); 
    }
}