<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function payTransaction(Request $request, $transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        // Check if the user is authorized to pay for this transaction
        if ($transaction->buyer_id !== auth()->id()) {
            return back()->withErrors('You are not authorized to pay for this transaction.');
        }

        // Simulate payment process (replace with real payment logic)
        try {
            // Assuming payment was successful
            $transaction->status = 'succeeded';
            $transaction->save();

            return redirect()->route('bids.index')->with('success', 'Payment was successful, transaction completed.');
        } catch (\Exception $e) {
            // Handle payment failure
            $transaction->status = 'failed';
            $transaction->save();

            return back()->withErrors('Payment failed. Please try again.');
        }
    }
}
