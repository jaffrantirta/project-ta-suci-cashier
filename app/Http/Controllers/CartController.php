<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $item = Item::where('sku', $request->sku)->first();

        // dd($item);

        if (!$item) {
            return redirect()->back()->with('error', 'Barang tidak ada');
        }

        $stock = Stock::where('item_id', $item->id)->latest()->first();

        if (!$stock) {
            return redirect()->back()->with('error', 'Stok belum dimasukan');
        }

        if ($stock->amount < 1) {
            return redirect()->back()->with('error', 'Stok barang habis');
        }

        \Cart::add($item->id, $item->name, $item->price, 1, []);

        return redirect()->back();
    }

    public function update(Request $request, $cart)
    {
        $result = $request->quantity - \Cart::get($cart)->quantity;
        \Cart::update($cart, array(
            'quantity' => $result
        ));

        return redirect()->back();
    }

    public function destroy($cart)
    {
        \Cart::remove($cart);
    }

    public function clear()
    {
        \Cart::clear();
    }
}
