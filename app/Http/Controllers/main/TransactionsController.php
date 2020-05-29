<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transactions as Tx;
use App\Card;
use \stdClass;

class TransactionsController extends Controller {

    /*
    * CRUD
    */

    public function index() {
        $transaction = Tx::all();
    }

    public function store(Request $request) {
        $transaction = Tx::create($request->all());
        $name=$request->input('card_name');
        $id = Card::where('name', $name)->get('id');
        $card = Card::find($id[0]['id']);

        return redirect()->action('main\ListController@read_one', ['id' => $card]);
    }

    public function show($id) {
        $transaction = Tx::find($id);
    }

    public function update(Request $request, $id) {
        $transaction = Tx::find($id);

        $transaction->status = $this->getStatus();
        $transaction->certified = $this->isCertified();
        $transaction->date_recieved = $this->getDateRecieved();
        $transaction->save();
    }

    public function destroy($id) {
        $transaction = Tx::find($id);
        $transaction->delete();
    }

    public function restore($id) {
        $transaction = Tx::withTrashed()->find($id)->restore();
    }

    /*
    * Controller Methods
    */

    public function cart_view() {
        $card1 = new stdClass();
        $card1->id = 12;
        $card1->name = 'Alice';
        $card1->seller = "test";
        $card1->price = 5;
        $card1->quantity = 12;
        $card2 = new stdClass();
        $card2->id = 11;
        $card2->name = 'Alice2';
        $card2->seller = "test2";
        $card2->price = 2;
        $card2->quantity = 14;
        $card3 = new stdClass();
        $card3->id = 10;
        $card3->name = 'Alice3';
        $card3->seller = "test3";
        $card3->price = 15;
        $card3->quantity = 15;

        $items = [$card1, $card2, $card3];

        $cart = array(
            "seller" => 'test',
            "buyer" => 'test2',
            "t_quantity" => $this->getTotalQuantity(),
            "t_price" => $this->getTotalPrice(),
            "status" => "paid"
        );

        $card_list = array();

        foreach ($items as $item) {
            $list = new stdClass();
            $list->id = $item->id;
            $list->name = $item->name;
            $list->price = $item->price;
            $list->quantity = $item->quantity;

            array_push($card_list, $list);
        }

        return response()->view('view_cart', ['card' => $cart, 'card_list' => $card_list]);
    }

    private function getTotalQuantity() {
        return 7;
    }

    private function getTotalPrice() {
        return 17;
    }
}