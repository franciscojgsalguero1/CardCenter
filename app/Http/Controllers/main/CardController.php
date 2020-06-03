<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Card;
use App\CardList;

class CardController extends Controller {
    private $html = "text/html";
    private $json = "javascript/json";

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

        $response = response()->view('view_cards', ['data' => $cards], 200);
        $response->header("Content-Type", $this->html);

        return $response;
    }

    public function viewjuego($juego) {
        $cards = Card::all()->where('game', $juego);

        $response = response()->view('view_cards', ['data' => $cards], 200);
        $response->header("Content-Type", $this->html);

        return $response;
    }

    public function add_cards() {
        return response()->view('add_cards', ['cards' => Card::all()]);
    }
    
    public function main(){
        $salida =[];
        $carta = Card::all();
        $venta = CardList::all();
        foreach ($venta as $nombre => $valor) {
            foreach ($carta as $nombre => $value) {
                if ($valor['name']==$value['name']){
                    if ($value['game']=='Force of Will'){
                        array_push($salida, $valor);
                    }
                }
            }
        }
        return response()->view('main',[
            'first_cards' => Card::all()->where('game', 'Force of Will')->sortBy('updated_at')->take(10),
            'cardlist' => $salida,
            'all_cards' => Card::all() 
        ]); 
    }

    public function mainGames($id){
        $salida =[];
        $carta = Card::all();
        $venta = CardList::all();
        foreach ($venta as $nombre => $valor) {
            foreach ($carta as $nombre => $value) {
                if ($valor['name']==$value['name']){
                    if ($value['game']==$id){
                        array_push($salida, $valor);
                    }
                }
            }
        }
        return response()->view('main',[
            'first_cards' => Card::all()->where('game',$id)->sortBy('updated_at')->take(10),
            'cardlist' => $salida,
            'all_cards' => Card::all(),
            'id' => $id
        ]); 
    }
}