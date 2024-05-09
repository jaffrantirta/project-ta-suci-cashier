<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpnameStoreRequest;
use App\Http\Requests\OpnameUpdateRequest;
use App\Models\Item;
use App\Models\Opname;
use App\Queries\OpnameQuery;

class OpnameController extends Controller
{
    public function index(OpnameQuery $opnameQuery)
    {
        return view('opname.index', [
            'opnames' => $opnameQuery->includes()->filterSortPaginateWithAppend()
        ]);
    }

    public function create()
    {
        return view('opname/create');
    }

    public function store(OpnameStoreRequest $request)
    {
        $item = Item::where('sku', $request->input('sku'))->firstOrFail();
        $item->opname()->create($request->validated());
        return redirect('opname')->with('success', 'Stok opname ditambahkan');
    }

    public function show($opname, OpnameQuery $query)
    {
        return $query->includes()->findAndAppend($opname);
    }

    public function update(OpnameUpdateRequest $request, Opname $opname)
    {
        $opname->update($request->validated());
        return $opname;
    }

    public function destroy(Opname $opname)
    {
        $opname->delete();
        return response()->noContent();
    }
}
