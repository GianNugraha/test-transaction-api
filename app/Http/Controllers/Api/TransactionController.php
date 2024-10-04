<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TrxTransactionBatch;
use App\Models\TrxSalesTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function createTransaction(Request $request)
    {
        $request->validate([
            'transaction_number' => 'required',
            'customer_id' => 'required',
            'employee_id' => 'required',
            'items' => 'required|array',
        ]);

        $transaction = TrxTransactionBatch::create([
            'transaction_number' => $request->transaction_number,
            'customer_id' => $request->customer_id,
            'employee_id' => $request->employee_id,
            'transaction_time' => now(),
            'created_by' => auth()->id(),
        ]);

        foreach ($request->items as $item) {
            TrxSalesTransaction::create([
                'transaction_batch_id' => $transaction->id,
                'item_id' => $item['item_id'],
                'qty' => $item['qty'],
                'item_price' => $item['item_price'],
                'total_gross_price' => $item['total_gross_price'],
                'discount' => $item['discount'],
                'created_by' => auth()->id(),
            ]);
        }

        return response()->json($transaction, 201);
    }

    public function listTransactions()
    {
        return response()->json(TrxTransactionBatch::with('salesTransactions')->get());
    }

    public function getTransactionDetails($id)
    {
        $transaction = TrxTransactionBatch::with('salesTransactions')->findOrFail($id);
        return response()->json($transaction);
    }
}
