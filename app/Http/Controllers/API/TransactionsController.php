<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transactions;

class TransactionsController extends Controller {
    public function index() {
        $transaction = Transactions::all();

        return $this->sendMessage("transaction", $transaction);
    }

    public function store(Request $request) {
        $transaction = Transactions::create($request->all());

        return $this->sendMessage("transaction", $transaction);
    }

    public function show($id) {
        $transaction = Transactions::find($id);

        return $this->sendMessage("transaction", $transaction);
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

        return $this->sendMessage("transaction", $transaction);
    }

    public function destroy($id) {
        $transaction = Transactions::find($id);
        $transaction->delete();

        return $this->sendMessage("message", "The transaction with the id $transaction->id has successfully been deleted.");
    }

    public function restore($id) {
        $transaction = Transactions::withTrashed()->find($id)->restore();
        return $this->sendMessage("message", "The transaction with the id $id has successfully been restored.");
    }

    private function sendMessage($key, $message) {
        return response()->json([
            'error' => false,
            $key => $message,
        ], 200);
    }
}
