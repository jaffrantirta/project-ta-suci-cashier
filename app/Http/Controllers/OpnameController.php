<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpnameStoreRequest;
use App\Http\Requests\OpnameUpdateRequest;
use App\Models\Item;
use App\Models\Opname;
use App\Models\Stock;
use App\Queries\OpnameQuery;
use Illuminate\Support\Facades\DB;

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
        return view('opname/create', [
            'items' => Item::all(),
        ]);
    }

    public function store(OpnameStoreRequest $request)
    {
        $item = Item::where('sku', $request->input('sku'))->firstOrFail();
        if ($request->diff_stock > $item->stocks()->latest()->first()->amount) {
            return redirect('opname')->with('error', 'Stok opname melebihi stok pada sistem');
        }
        $real_stock = $item->stocks()->latest()->first()->amount - $request->diff_stock;
        // return $real_stock;
        DB::beginTransaction();
        $item->opname()->create(array_merge($request->validated(), ['real_stock' => $real_stock]));
        Stock::create([
            'item_id' => $item->id,
            'change_amount' => -$request->diff_stock,
            'amount' => 0,
            'supplier_name' => 'note: opname (' . $request->comment . ')'
        ]);
        DB::commit();
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
