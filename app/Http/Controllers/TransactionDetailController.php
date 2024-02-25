<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionDetailStoreRequest;
use App\Http\Requests\TransactionDetailUpdateRequest;
use App\Models\TransactionDetail;
use App\Queries\TransactionDetailQuery;

class TransactionDetailController extends Controller
{
    public function index(TransactionDetailQuery $transactiondetailQuery)
    {
        return $transactiondetailQuery->includes()->filterSortPaginateWithAppend();
    }

    public function store(TransactionDetailStoreRequest $request)
    {
        return TransactionDetail::create($request->validated());
    }

    public function show($transactiondetail, TransactionDetailQuery $query)
    {
        return $query->includes()->findAndAppend($transactiondetail);
    }

    public function update(TransactionDetailUpdateRequest $request, TransactionDetail $transactiondetail)
    {
        $transactiondetail->update($request->validated());
        return $transactiondetail;
    }

    public function destroy(TransactionDetail $transactiondetail)
    {
        $transactiondetail->delete();
        return response()->noContent();
    }
}
