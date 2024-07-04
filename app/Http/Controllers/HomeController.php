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
            ->limit(5)
            ->get();

        $bestSellerNames = $bestSeller->pluck('item.name');
        $bestSellerQuantities = $bestSeller->pluck('quantity');

        // Running low stock logic
        $runningLowStock = [];
        $items = Item::with('item_unit')->get();
        foreach ($items as $item) {
            if ($item->stock?->amount < 20) {
                    $runningLowStock[] = $item;
            }
        }

        // Transactions today and yesterday
        $transactionsToday = Transaction::whereDate('created_at', Carbon::today())->count();
        $transactionsYesterday = Transaction::whereDate('created_at', Carbon::yesterday())->count();

        // Monthly sales data for the current year
        $monthlySales = Transaction::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as sales')
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month')
            ->toArray();

        $monthlySalesData = [];
        foreach ($monthlySales as $month => $data) {
            $monthlySalesData[$this->convertMonthNumberToName($data['month'])] = $data['sales'];
        }
        // dd($monthlySales);

        return view('home', compact(
            'bestSellerNames',
            'bestSellerQuantities',
            'transactionsToday',
            'runningLowStock',
            'transactionsYesterday',
            'monthlySalesData'
        ));
    }

    private function convertMonthNumberToName($monthNumber)
    {
        return date('F', mktime(0, 0, 0, $monthNumber, 10));
    }

    public function fetchTransactionsByDate(Request $request)
    {
        $date = $request->input('date');
        $transactionsCount = Transaction::whereDate('created_at', $date)->count();

        return response()->json([
            'date' => $date,
            'transactionsCount' => $transactionsCount
        ]);
    }
}
