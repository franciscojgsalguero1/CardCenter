<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transactions;
use App\CardList;
use App\Card;
use App\User;

class TransactionsController extends Controller {

    /*
    * CRUD
    */

    public function index() {
        $transactions = Transactions::all();
    }

    public function store(Request $request) {
        $transactions = Transactions::create($request->all());
        $name = $request->input('card_name');
        $id = Card::where('name', $name)->get('id');
        $card = Card::find($id[0]['id']);
        $transactions = Transactions::where('buyer', $name)->
                        where('status', 'added')->get();

        return redirect()->action('main\ListController@read_one', [
            'id' => $card,
            'transactions' => $transactions
        ]);
    }

    public function show($id) {
        $transactions = Transactions::find($id);
    }

    public function update(Request $request, $id) {
        $transactions = Transactions::find($id);
        $transactions->status = $this->getStatus();
        $transactions->certified = $this->isCertified();
        $transactions->date_recieved = $this->getDateRecieved();
        $transactions->save();
    }

    public function destroy($id) {
        $transactions = Transactions::find($id);
        $transactions->delete();
    }

    public function restore($id) {
        $transactions = Transactions::withTrashed()->find($id)->restore();
    }

    /*
    * Controller Methods
    */

    public function transactionToBuy($name){   
        $transactions = Transactions::where('buyer', $name)->
                        where('status', 'added')->get();
        return response()->view('transactions', ['transactions' => $transactions]);
    }

    public function buyAllItems($name) {
        $transactions = Transactions::where('buyer', $name)->where('status', 'added')->get();
        $buyer_id = User::where('username', $name)->get('id');
        $buyer = User::find($buyer_id[0]['id']);
        $total_purchase_price = 0;

        foreach ($transactions as $transaction) {
            $seller_id = User::where('username', $transaction->seller)->get('id');
            $seller = User::find($seller_id[0]['id']);
            $total_price = $transaction->t_quantity * $transaction->price_unit;
            $total_purchase_price = $total_purchase_price + $total_price;
        }

        if ($buyer->balance >= $total_purchase_price) {
            foreach ($transactions as $transaction) {
                // Obtaining objects
                $seller_id = User::where('username', $transaction->seller)->get('id');
                $seller = User::find($seller_id[0]['id']);
                $card_id = Card::where("name", $transaction->card_name)->get('id');
                $card = Card::find($card_id[0]['id']);
                $cardlist = CardList::find($transaction->card_id);

                // Updating Seller                
                $seller->balance = $seller->balance + ($transaction->price_unit * $transaction->t_quantity);
                $seller->save();

                // Updating Buyer
                $buyer->balance = $buyer->balance - ($transaction->price_unit * $transaction->t_quantity);
                $buyer->save();

                // Updating Transactions
                $transaction->status = "sold";
                $transaction->date_paid = date("Y-m-d");
                $transaction->save();
                
                // Updating Card
                $card->quantity = $card->quantity - $transaction->t_quantity;
                $card->save();
                
                // Updating or Deleting Card List
                if ($cardlist->quantity == $transaction->t_quantity) {
                    $cardlist->delete();
                } else {
                    $cardlist->quantity = $cardlist->quantity - $transaction->t_quantity;
                    $cardlist->save();
                }
            }
        }

        return redirect()->back();
    }

    public function deleteTransaction($id, $amount){
        $transactions = Transactions::find($id);
        if ($transactions->t_quantity == $amount) {
            $transactions->delete();
        } else {
            $transactions->t_quantity = $transactions->t_quantity - $amount;
            $transactions->save();   
        }
       
        return redirect()->back();
    }
}