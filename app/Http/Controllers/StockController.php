<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockStoreRequest;
use App\Http\Requests\StockUpdateRequest;
use App\Models\Item;
use App\Models\Stock;
use App\Queries\StockQuery;
use Carbon\Carbon;

class StockController extends Controller
{
    public function index(StockQuery $stockQuery)
    {
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
        Stock::create(array_merge($request->validated(), ['number_of_invoice' => $this->generateInvoiceNumber()]));
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
