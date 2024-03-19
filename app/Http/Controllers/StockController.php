<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockStoreRequest;
use App\Http\Requests\StockUpdateRequest;
use App\Models\Stock;
use App\Queries\StockQuery;

class StockController extends Controller
{
    public function index(StockQuery $stockQuery)
    {
        return view('stock/index', [
            'stocks' => $stockQuery->includes()->filterSortPaginateWithAppend()
        ]);
    }

    public function store(StockStoreRequest $request)
    {
        return Stock::create($request->validated());
    }

    public function show($stock, StockQuery $query)
    {
        return $query->includes()->findAndAppend($stock);
    }

    public function update(StockUpdateRequest $request, Stock $stock)
    {
        $stock->update($request->validated());
        return $stock;
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return response()->noContent();
    }
}
