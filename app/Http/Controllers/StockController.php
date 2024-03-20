<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockStoreRequest;
use App\Http\Requests\StockUpdateRequest;
use App\Models\Item;
use App\Models\Stock;
use App\Queries\StockQuery;

class StockController extends Controller
{
    public function index(StockQuery $stockQuery)
    {
        // dd(Stock::all());
        return view('stock/index', [
            'stocks' => $stockQuery->includes()->filterSortPaginateWithAppend()
        ]);
    }

    public function create()
    {
        return view('stock/create', [
            'items' => Item::all()
        ]);
    }

    public function store(StockStoreRequest $request)
    {
        Stock::create($request->validated());
        return redirect('stock')->with('success', 'Stok telah disismpan');
    }

    public function show($stock, StockQuery $query)
    {
        return view('stock/show', [
            'stock' => $query->includes()->findAndAppend($stock),
        ]);
    }

    public function update(StockUpdateRequest $request, Stock $stock)
    {
        $stock->update($request->validated());
        return redirect('stock')->with('success', 'Stok telah diperbaharui');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect('stock')->with('success', 'Stok telah dihapus');
    }
}
