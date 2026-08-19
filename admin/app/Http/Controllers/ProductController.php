<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id')->get();

        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'spesifikasi' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        Product::create($validated);

        return back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'spesifikasi' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $product->update($validated);

        return back()->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}