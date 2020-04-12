<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transactions;

class TransactionsController extends Controller {
    public function index() {
        $transaction = Transactions::all();
    }

    public function store(Request $request) {
        $transaction = Transactions::create($request->all());
    }

    public function show($id) {
        $transaction = Transactions::find($id);
    }

    public function update(Request $request, $id) {
        $transaction = Transactions::find($id);

        $transaction->status = $this->getStatus();
        $transaction->certified = $this->isCertified();
        $transaction->tracking_code = $this->getTrackingCode();
        $transaction->date_paid = $this->getDatePaid();
        $transaction->date_sent = $this->getDateSent();
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
}
