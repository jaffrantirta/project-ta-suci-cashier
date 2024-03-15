<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Models\Item;
use App\Queries\ItemQuery;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function index(ItemQuery $itemQuery)
    {
        return view('item/item', [
            'items' => $itemQuery->includes()->filterSortPaginateWithAppend()
        ]);
    }

    public function create()
    {
        return view('item/create');
    }

    public function store(ItemStoreRequest $request)
    {
        Item::create($request->validated());
        return redirect('item');
    }

    public function show($item, ItemQuery $query)
    {
        return $query->includes()->findAndAppend($item);
    }

    public function update(ItemUpdateRequest $request, Item $item)
    {
        $item->update($request->validated());
        return redirect('item');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->noContent();
    }
}
