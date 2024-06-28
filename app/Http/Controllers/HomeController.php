<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Best seller logic
        $bestSeller = Stock::where('change_amount', '<', 0)
            ->select('item_id', DB::raw('SUM(change_amount) as quantity'))
            ->groupBy('item_id')
            ->orderBy('quantity', 'asc')
            ->with('item')
            ->get();

        $bestSellerNames = $bestSeller->pluck('item.name');
        $bestSellerQuantities = $bestSeller->pluck('quantity');

        // Running low stock logic
        $runningLowStock = [];
        $items = Item::all();
        foreach ($items as $key => $value) {
            if ($value->stock?->amount < 20) {
                array_push($runningLowStock, $value);
            }
        }

        // Transactions today and yesterday
        $transactionsToday = Transaction::whereDate('created_at', Carbon::today())->count();
        $transactionsYesterday = Transaction::whereDate('created_at', Carbon::yesterday())->count();

        // Monthly sales data for the current year
        $monthlySales = Transaction::select(
            DB::raw('MONTHNAME(created_at) as month'),
            DB::raw('COUNT(*) as sales')
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month')
            ->toArray();

        // Initialize an array for monthly sales data
        // $monthlySalesData = ['January'];
        foreach ($monthlySales as $month => $data) {
            $monthlySalesData[$data['month']] = $data['sales'];
        }

        // return $monthlySalesData;

        return view('home', compact(
            'bestSellerNames',
            'bestSellerQuantities',
            'transactionsToday',
            'runningLowStock',
            'transactionsYesterday',
            'monthlySalesData'
        ));
    }
}
