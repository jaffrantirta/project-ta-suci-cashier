<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        // dd();
        // \Cart::session(auth()->user()->id);
    }

    public function index()
    {
        return 'hola';
        // $item = Item::where('sku', $sku);
        // \Cart::add($item->id, $item->name, $item->price, 1, array());
    }

    public function store(Request $request)
    {
        $item = Item::where('sku', $request->sku)->first();

        if (!$item) {
            return redirect()->back()->with('error', 'Barang tidak ada');
        }

        \Cart::add($item->id, $item->name, $item->price, 1, []);

        return redirect()->back()->with('success', 'Item added to cart successfully');
    }
}
