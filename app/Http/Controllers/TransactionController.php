<?php

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Http\Requests\TransactionStoreRequest;
use App\Http\Requests\TransactionUpdateRequest;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Queries\ItemQuery;
use App\Queries\TransactionQuery;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(TransactionQuery $transactionQuery)
    {
        return view('transaction/index', [
            'transactions' => $transactionQuery->includes()->filterSortPaginateWithAppend()
        ]);
    }

    public function create()
    {
        return view('transaction/create', [
            'cart' => \Cart::getContent(),
            'sub_total' => \Cart::getSubTotal()
        ]);
    }

    public function store(TransactionStoreRequest $request)
    {
        DB::beginTransaction();
        $transaction = Transaction::create([
            'number' => $this->generateInvoiceNumber(),
            'issued_by' => auth()->user()->id,
            'total_of_item' => \Cart::getTotalQuantity(),
            'total_of_amount' => \Cart::getSubTotal(),
            'payment_method' => 1,
            'attributes' => json_encode([
                'customer_name' => $request->customer_name,
                'customer_address' => $request->customer_address
            ])
        ]);
        $cart = \Cart::getContent();
        foreach ($cart as $item) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'item_id' => $item->id,
                'item_name' => $item->name,
                'item_price' => $item->price,
                'amount' => $item->quantity,
                'total' => $item->getPriceSum()
            ]);
        }
        DB::commit();
        \Cart::clear();
        return redirect()->back()->with('success', 'Tranaksi berhasil disimpan');
    }

    public function show($transaction, TransactionQuery $query)
    {
        return $query->includes()->findAndAppend($transaction);
    }

    public function update(TransactionUpdateRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());
        return $transaction;
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->noContent();
    }

    function generateInvoiceNumber()
    {
        // Get the current month in Roman numerals
        $monthInRoman = Carbon::now()->format('M');

        // Get the current year
        $year = Carbon::now()->format('Y');

        // Get the current number of invoices for the month
        $currentMonthInvoicesCount = Transaction::whereYear('created_at', $year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        // Increment the count by 1 for the new invoice
        $invoiceNumber = $currentMonthInvoicesCount + 1;

        // Format the invoice number
        $formattedInvoiceNumber = sprintf('#NOTA/%s/%s/%d', $monthInRoman, $year, $invoiceNumber);

        return $formattedInvoiceNumber;
    }
}
