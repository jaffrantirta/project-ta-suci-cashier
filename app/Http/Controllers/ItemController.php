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
        return view('item/index', [
            'items' => $itemQuery->includes()->filterSortPaginateWithAppend()
        ]);
    }

    public function create()
    {
        return view('item/create');
    }

    public function store(ItemStoreRequest $request)
    {
        Item::create(array_merge($request->validated(), ['sku' => $this->generateItemId()]));
        return redirect('item')->with('success', 'Item created successfully.');
    }

    protected function generateItemId()
    {
        $latestItem = Item::orderBy('id', 'desc')->first();
        $latestItemId = $latestItem ? $latestItem->id : 0;
        $latestItemId += 1;
        $itemId = str_pad($latestItemId, 4, '0', STR_PAD_LEFT);
        return 'BRG' . $itemId;
    }

    public function show($item, ItemQuery $query)
    {
        return view('item/create', [
            'item' => $query->includes()->findAndAppend($item)
        ]);
    }

    public function edit($item, ItemQuery $query)
    {
        return view('item/create', [
            'item' => $query->includes()->findAndAppend($item)
        ]);
    }

    public function update(ItemUpdateRequest $request, Item $item)
    {
        $item->update($request->validated());
        return redirect('item')->with('success', 'Item updated successfully');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->noContent();
    }
}
