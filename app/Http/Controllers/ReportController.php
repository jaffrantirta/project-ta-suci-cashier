<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
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
        ]);
        if ($request->type == 'stock') {
            $data = Stock::whereBetween('created_at', [$request->from_date, $request->to_date])
                ->where('change_amount', '>', 0)
                ->with('item')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $data = Transaction::whereBetween('created_at', [$request->from_date, $request->to_date])
                ->orderBy('created_at', 'desc')
                ->get();
        }
        // dd($data);

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
