<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemUnitStoreRequest;
use App\Http\Requests\ItemUnitUpdateRequest;
use App\Models\ItemUnit;
use App\Queries\ItemUnitQuery;

class ItemUnitController extends Controller
{
    public function index(ItemUnitQuery $itemUnitQuery)
    {
        return view('itemunit/index', [
            'itemunits' => $itemUnitQuery->includes()->filterSortPaginateWithAppend()
        ]);
    }

    public function create()
    {
        return view('itemunit/create');
    }

    public function store(ItemUnitStoreRequest $request)
    {
        ItemUnit::create($request->validated());
        return redirect('itemunit')->with('success', 'Item unit created successfully.');
    }

    public function show($itemunit, ItemUnitQuery $query)
    {
        return view('itemunit/create', [
            'itemunit' => $query->includes()->findAndAppend($itemunit),
        ]);
    }

    public function edit($itemunit, ItemUnitQuery $query)
    {
        return view('itemunit/create', [
            'itemunit' => $query->includes()->findAndAppend($itemunit)
        ]);
    }

    public function update(ItemUnitUpdateRequest $request, ItemUnit $itemunit)
    {
        $itemunit->update($request->validated());
        return redirect('itemunit')->with('success', 'Item updated successfully');
    }

    public function destroy(ItemUnit $itemunit)
    {
        $itemunit->delete();
        return response()->noContent();
    }
}
