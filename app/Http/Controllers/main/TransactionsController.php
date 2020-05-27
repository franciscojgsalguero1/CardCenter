<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transactions as Tx;
use App\Card;

class TransactionsController extends Controller {
    public function index() {
        $transaction = Tx::all();
    }

    public function store(Request $request) {
        $transaction = Tx::create($request->all());
        $name=$request->input('card_name');
        $id = Card::where('name', $name)->get('id');
        $card = Card::find($id[0]['id']);

        return redirect()->action(
            'main\ListController@read_one', ['id' => $card]);
        
    }

    public function show($id) {
        $transaction = Tx::find($id);
    }

    public function update(Request $request, $id) {
        $transaction = Tx::find($id);

        $transaction->confirm =$this->getconfirm();
        $transaction->status = $this->getStatus();
        $transaction->certified = $this->isCertified();
        $transaction->tracking_code = $this->getTrackingCode();
        $transaction->date_paid = $this->getDatePaid();
        $transaction->date_sent = $this->getDateSent();
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
    public function test($name) {

        $transaction = Tx::where('buyer', $name)->get();
        $response = response()->view('view_buy', ['data' => $transaction]);

         return $response;
    }
    public function updateConfirm($id){
        $salida = Tx::find($id);

        if($salida){
            $salida->confirm= '1';
            $salida->save();
        }

       
    }

}
