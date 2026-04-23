<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Transactions;
use App\Models\TransactionDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    // Tampilkan halaman kasir dengan data keranjang
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('checkout')
                             ->with('success', 'Keranjang masih kosong.');
        }

        // Ambil data item terbaru dari DB (termasuk stok)
        $cartItems = [];
        $total = 0;
        foreach ($cart as $id => $cartItem) {
            $item = Items::find($id);
            if ($item) {
                $cartItems[$id] = [
                    'id'    => $item->id,
                    'name'  => $item->name,
                    'price' => $item->price,
                    'stock' => $item->stock,
                ];
                $total += $item->price; // default qty 1
            }
        }

        return view('cashier', compact('cartItems', 'total'));
    }

    // Proses pembayaran
    public function pay(Request $request)
    {
        $request->validate([
            'qty'       => 'required|array',
            'qty.*'     => 'required|integer|min:1',
            'pay_total' => 'required|integer|min:0',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('selectitem');
        }

        // Hitung total & validasi stok
        $total = 0;
        foreach ($cart as $id => $cartItem) {
            $item = Items::findOrFail($id);
            $qty = $request->qty[$id] ?? 1;

            if ($qty > $item->stock) {
                return back()->withErrors([
                    'qty' => "Stok {$item->name} tidak cukup. Stok tersedia: {$item->stock}"
                ]);
            }

            $total += $item->price * $qty;
        }

        if ($request->pay_total < $total) {
            return back()->withErrors([
                'pay_total' => 'Uang bayar kurang dari total harga.'
            ])->withInput();
        }

        // Simpan ke tabel transactions
        $transaction = Transactions::create([
            'user_id'   => Auth::id(),
            'date'      => now(),
            'total'     => $total,
            'pay_total' => $request->pay_total,
        ]);

        // Simpan ke tabel transaction_details & kurangi stok
        foreach ($cart as $id => $cartItem) {
            $item = Items::findOrFail($id);
            $qty = $request->qty[$id] ?? 1;

            TransactionDetails::create([
                'transaction_id' => $transaction->id,
                'item_id'        => $item->id,
                'qty'            => $qty,
                'subtotal'       => $item->price * $qty,
            ]);

            // Kurangi stok
            $item->decrement('stock', $qty);
        }

        // Kosongkan keranjang
        session()->forget('cart');

        return redirect()->route('nota', $transaction->id);
    }
    public function nota($id)
    {
        $transaction = Transactions::with(['details.item', 'user'])->findOrFail($id);
        $kembalian = $transaction->pay_total - $transaction->total;
        return view('nota', compact('transaction', 'kembalian'));
    }
}