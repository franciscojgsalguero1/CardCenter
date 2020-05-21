<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transactions as Tx;

class TransactionsController extends Controller {
    public function index() {
        $transaction = Tx::all();
    }

    public function store(Request $request) {
        $transaction = Tx::create($request->all());
    }

    public function show($id) {
        $transaction = Tx::find($id);
    }

    public function update(Request $request, $id) {
        $transaction = Tx::find($id);

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
}
