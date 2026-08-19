<?php

namespace App\Http\Controllers;

use App\Models\Schema;
use Illuminate\Http\Request;

class SchemaController extends Controller
{
    public function index()
    {
        $schemas = Schema::withCount('orders')->orderBy('id')->get();

        return view('schemas.index', compact('schemas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'skema' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'numeric', 'min:0'],
            'satuan' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:Aktif,Tidak Aktif'],
        ]);

        Schema::create($validated);

        return back()->with('success', 'Skema berhasil ditambahkan.');
    }

    public function update(Request $request, Schema $schema)
    {
        $validated = $request->validate([
            'skema' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'numeric', 'min:0'],
            'satuan' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:Aktif,Tidak Aktif'],
        ]);

        $schema->update($validated);

        return back()->with('success', 'Skema berhasil diperbarui.');
    }

    public function destroy(Schema $schema)
    {
        $schema->orders()->update(['schema_id' => null]);
        $schema->delete();

        return back()->with('success', 'Skema berhasil dihapus.');
    }
}