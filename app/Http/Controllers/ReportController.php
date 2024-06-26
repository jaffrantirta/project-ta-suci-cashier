<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Opname;
use App\Models\Stock;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('report/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date|before_or_equal:today',
            'to_date' => 'required|date|after_or_equal:from_date',
            'type' => 'required',
            'payment_method' => 'nullable',
        ]);

        // dd($request->payment_method);

        if ($request->type == 'stock') {
            $data = Stock::whereBetween('created_at', [Carbon::parse($request->from_date)->startOfDay(), Carbon::parse($request->to_date)->endOfDay()])
                ->where('change_amount', '>', 0)
                ->with('item')
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($request->type == 'stockout') {
            $data = Stock::whereBetween('created_at', [Carbon::parse($request->from_date)->startOfDay(), Carbon::parse($request->to_date)->endOfDay()])
                ->where('change_amount', '<', 0)
                ->with('item')
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($request->type == 'opname') {
            $data = Opname::whereBetween('created_at', [Carbon::parse($request->from_date)->startOfDay(), Carbon::parse($request->to_date)->endOfDay()])
                ->with('item')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $data = Transaction::whereBetween('created_at', [Carbon::parse($request->from_date)->startOfDay(), Carbon::parse($request->to_date)->endOfDay()])
                ->when(!empty($request->payment_method), function ($query) use ($request) {
                    return $query->where('payment_method', $request->payment_method);
                })
                ->orderBy('created_at', 'desc')
                ->with('transaction_details.item')
                ->get();
        }
        // dd(Opname::whereBetween('created_at', [$request->from_date, $request->to_date])->get());

        if ($data == null) {
            return redirect()->back()->with('error', 'Data Tidak Ditemukan');
        }

        $pdf = Pdf::loadView('PDFs.report', [
            'data' => $data,
            'type' => $request->type,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date
        ]);

        return $pdf->stream();
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
