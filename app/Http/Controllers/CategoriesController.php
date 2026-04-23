<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Categories::create(['name' => $request->name]);

        return redirect()->route('category')
                         ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Categories::findOrFail($id)->delete();

        return redirect()->route('category')
                         ->with('success', 'Kategori berhasil dihapus!');
    }
}