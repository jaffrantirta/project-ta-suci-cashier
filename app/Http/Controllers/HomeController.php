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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bestSeller = Stock::where('change_amount', '<', 0)
            ->select('item_id', DB::raw('SUM(change_amount) as quantity'))
            ->groupBy('item_id')
            ->orderBy('quantity', 'asc')
            ->with('item')
            ->get();

        $runningLowStock = [];
        $items = Item::all();
        foreach ($items as $key => $value) {
            if ($value->stock?->amount < 20) {
                array_push($runningLowStock, $value);
            }
        }

        $transactionsToday = Transaction::whereDate('created_at', Carbon::today())->count();
        $transactionsYesterday = Transaction::whereDate('created_at', Carbon::yesterday())->count();
        return view('home', compact('bestSeller', 'transactionsToday', 'runningLowStock', 'transactionsYesterday'));
    }
}
