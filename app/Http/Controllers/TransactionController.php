<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionStoreRequest;
use App\Http\Requests\TransactionUpdateRequest;
use App\Models\Transaction;
use App\Queries\ItemQuery;
use App\Queries\TransactionQuery;

class TransactionController extends Controller
{
    public function index(TransactionQuery $transactionQuery)
    {
        return view('transaction/index', [
            'transactions' => $transactionQuery->includes()->filterSortPaginateWithAppend()
        ]);
    }

    public function create()
    {
        return view('transaction/create', [
            'cart' => \Cart::getContent(),
            'sub_total' => \Cart::getSubTotal()
        ]);
    }

    public function store(TransactionStoreRequest $request)
    {
        return Transaction::create($request->validated());
    }

    public function show($transaction, TransactionQuery $query)
    {
        return $query->includes()->findAndAppend($transaction);
    }

    public function update(TransactionUpdateRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());
        return $transaction;
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->noContent();
    }
}
