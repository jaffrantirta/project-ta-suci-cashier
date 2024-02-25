<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemStockStoreRequest;
use App\Http\Requests\ItemStockUpdateRequest;
use App\Models\ItemStock;
use App\Queries\ItemStockQuery;

class ItemStockController extends Controller
{
    public function index(ItemStockQuery $itemstockQuery)
    {
        return $itemstockQuery->includes()->filterSortPaginateWithAppend();
    }

    public function store(ItemStockStoreRequest $request)
    {
        return ItemStock::create($request->validated());
    }

    public function show($itemstock, ItemStockQuery $query)
    {
        return $query->includes()->findAndAppend($itemstock);
    }

    public function update(ItemStockUpdateRequest $request, ItemStock $itemstock)
    {
        $itemstock->update($request->validated());
        return $itemstock;
    }

    public function destroy(ItemStock $itemstock)
    {
        $itemstock->delete();
        return response()->noContent();
    }
}
