<?php

namespace App\Http\Controllers;

use App\Models\Stock;
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

        return view('home', compact('bestSeller'));
    }
}
