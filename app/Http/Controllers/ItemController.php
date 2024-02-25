<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Models\Item;
use App\Queries\ItemQuery;

class ItemController extends Controller
{
    public function index(ItemQuery $itemQuery)
    {
        return $itemQuery->includes()->filterSortPaginateWithAppend();
    }

    public function store(ItemStoreRequest $request)
    {
        return Item::create($request->validated());
    }

    public function show($item, ItemQuery $query)
    {
        return $query->includes()->findAndAppend($item);
    }

    public function update(ItemUpdateRequest $request, Item $item)
    {
        $item->update($request->validated());
        return $item;
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->noContent();
    }
}
