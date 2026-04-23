<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Categories;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Items::with('category')->get();
        $categories = Categories::all();
        return view('item', compact('items', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        Items::create($request->only('category_id', 'name', 'price', 'stock'));

        return redirect()->route('item')
                         ->with('success', 'Item berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Items::findOrFail($id)->delete();

        return redirect()->route('item')
                         ->with('success', 'Item berhasil dihapus!');
    }

    public function selectitem()
    {
        $items = Items::with('category')->get();
        return view('selectitem', compact('items'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'selected_items' => 'required|array|min:1',
            'selected_items.*' => 'exists:items,id',
        ]);

        $cart = session()->get('cart', []);

        foreach ($request->selected_items as $itemId) {
            $item = Items::findOrFail($itemId);
            if (!isset($cart[$itemId])) {
                $cart[$itemId] = [
                    'id'    => $item->id,
                    'name'  => $item->name,
                    'price' => $item->price,
                    'stock' => $item->stock,
                ];
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('checkout')
                         ->with('success', 'Item berhasil ditambahkan ke keranjang!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_column($cart, 'price'));
        return view('checkout', compact('cart', 'total'));
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->route('checkout')
                         ->with('success', 'Item dihapus dari keranjang.');
    }
}