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
        $transaction = Transactions::all();
    }

    public function store(Request $request) {
        $transaction = Transactions::create($request->all());
        $name = $request->input('card_name');
        $id = Card::where('name', $name)->get('id');
        $card = Card::find($id[0]['id']);

        return redirect()->action('main\ListController@read_one', ['id' => $card]);
    }

    public function show($id) {
        $transaction = Transactions::find($id);
    }

    public function update(Request $request, $id) {
        $transaction = Transactions::find($id);
        $transaction->status = $this->getStatus();
        $transaction->certified = $this->isCertified();
        $transaction->date_recieved = $this->getDateRecieved();
        $transaction->save();
    }

    public function destroy($id) {
        $transaction = Transactions::find($id);
        $transaction->delete();
    }

    public function restore($id) {
        $transaction = Transactions::withTrashed()->find($id)->restore();
    }

    /*
    * Controller Methods
    */

    public function transactionToBuy($name){   
        $transaction = Transactions::where('buyer', $name)->
                        where('status', 'added')->get();
        return response()->view('transaction', ['transaction' => $transaction]);
    }

    public function buyAllItems($name) {
        $transactions = $transaction = Transactions::where('buyer', $name)->where('status', 'added')->get();
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
                $seller->balance = $seller->balance + $total_purchase_price;
                $seller->save();
                $buyer->balance = $buyer->balance - $total_purchase_price;
                $buyer->save();
                $transaction->status = "sold";
                $transaction->date_paid = date("Y-m-d");
                $transaction->save();
            }
        }

        return redirect()->back();
    }


    public function deleteTransaction($id){
        $transaction = Transactions::find($id);
        $transaction->delete();
        
        return redirect()->back();
    }
}