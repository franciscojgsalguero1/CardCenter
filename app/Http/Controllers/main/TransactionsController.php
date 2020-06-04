<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transactions;
use App\CardList;
use App\Card;

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

        foreach ($transactions as $transaction) {
            $transaction->status = "sold";
            $transaction->date_paid = date("Y-m-d");
            $transaction->save();
        }

        return redirect()->back();
    }


    public function deleteTransaction($id){
        $transaction = Transactions::find($id);
        $transaction->delete();
        
        return redirect()->back();
    }
}