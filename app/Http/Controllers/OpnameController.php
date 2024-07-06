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
        $diff_stock = $request->real_stock - $item->stock->amount;
        // return $real_stock;
        DB::beginTransaction();
        $item->opname()->create(array_merge($request->validated(), ['diff_stock' => $diff_stock]));
        Stock::create([
            'item_id' => $item->id,
            'change_amount' => $diff_stock,
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
