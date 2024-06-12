<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockStoreRequest;
use App\Http\Requests\StockUpdateRequest;
use App\Models\Item;
use App\Models\Stock;
use App\Queries\StockQuery;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index(StockQuery $stockQuery)
    {
        // return Stock::select('item_id', DB::raw('max(created_at) as created_at'))->groupBy('item_id')->with('item.stocks')->latest()->get();
        return view('stock/index', [
            // 'stocks' => $stockQuery->includes()->filterSortPaginateWithAppend()
            'stocks' => $stockQuery->select('item_id', DB::raw('max(created_at) as created_at'))->groupBy('item_id')->with('item.stocks')->latest()->paginate()
        ]);
    }

    public function showByItem(StockQuery $stockQuery)
    {
        return view('stock/showbyitem', [
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
        $data = $request->validated();

        foreach ($data['data'] as $stockData) {
            Stock::create([
                'item_id' => $stockData['item_id'],
                'supplier_name' => $data['supplier_name'],
                'change_amount' => $stockData['change_amount'],
                'amount' => $stockData['amount'] ?? null,
                'number_of_invoice' => $data['number_of_invoice'],
            ]);
        }

        return redirect('stock')->with('success', 'Stok telah disimpan');
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

    function generateInvoiceNumber()
    {
        // Get the current month in Roman numerals
        $monthInRoman = Carbon::now()->format('M');

        // Get the current year
        $year = Carbon::now()->format('Y');

        // Get the current number of invoices for the month
        $currentMonthInvoicesCount = Stock::whereYear('created_at', $year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        // Increment the count by 1 for the new invoice
        $invoiceNumber = $currentMonthInvoicesCount + 1;

        // Format the invoice number
        $formattedInvoiceNumber = sprintf('#NOTA/IN/%s/%s/%d', $monthInRoman, $year, $invoiceNumber);

        return $formattedInvoiceNumber;
    }
}
