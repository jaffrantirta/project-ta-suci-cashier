<?php

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Http\Requests\TransactionStoreRequest;
use App\Http\Requests\TransactionUpdateRequest;
use App\Models\Item;
use App\Models\Stock;
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
            'sub_total' => \Cart::getSubTotal(),
            'items' => Item::all()
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
            'payment_method' => $request->payment_method,
            'pay_amount' => $request->payment_method == '1' ? $request->pay_amount : \Cart::getSubTotal(),
            'change_amount' => $request->change_amount,
            'attributes' => json_encode([
                'customer_name' => $request->customer_name,
                'customer_address' => $request->customer_address,
                'customer_phone' => $request->customer_phone
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

            $stock = Stock::where('item_id', $item->id)->latest()->first();
            Stock::create([
                'item_id' => $item->id,
                'change_amount' => -$item->quantity,
                'amount' => 0,
            ]);
        }
        DB::commit();
        \Cart::clear();
        return redirect()->route('transaction.receipt', ['transaction' => $transaction, 'include[]' => 'transaction_details']);
    }

    public function receipt($transaction, TransactionQuery $query)
    {
        return view('transaction/receipt', [
            'transaction' => $query->includes()->findAndAppend($transaction)
        ]);
    }

    public function show($transaction, TransactionQuery $query)
    {
        return view('transaction/show', [
            'transaction' => $query->includes()->findAndAppend($transaction)
        ]);
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
