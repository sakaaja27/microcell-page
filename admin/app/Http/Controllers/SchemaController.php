<?php

namespace App\Http\Controllers;

use App\Models\Schema;
use Illuminate\Http\Request;

class SchemaController extends Controller
{
    public function index()
    {
        $schemas = Schema::withCount('orders')->orderBy('id')->paginate(10);

        return view('schemas.index', compact('schemas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'skema' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:255',
            'status' => 'required|string|in:Aktif,Tidak Aktif',
            'features' => 'nullable|string',
            'is_recommended' => 'nullable|boolean',
            'cta_text' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
        ]);

        if (!empty($validated['features'])) {
            $validated['features'] = json_encode(array_filter(array_map('trim', explode("\n", $validated['features']))));
        } else {
            $validated['features'] = null;
        }

        $validated['is_recommended'] = $request->has('is_recommended');
        $validated['cta_text'] = $validated['cta_text'] ?? 'Hubungi Kami';
        $validated['cta_link'] = $validated['cta_link'] ?? '#';

        Schema::create($validated);

        return back()->with('success', 'Skema berhasil ditambahkan');
    }

    public function update(Request $request, Schema $schema)
    {
        $validated = $request->validate([
            'skema' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:255',
            'status' => 'required|string|in:Aktif,Tidak Aktif',
            'features' => 'nullable|string',
            'is_recommended' => 'nullable|boolean',
            'cta_text' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
        ]);

        if (!empty($validated['features'])) {
            $validated['features'] = json_encode(array_filter(array_map('trim', explode("\n", $validated['features']))));
        } else {
            $validated['features'] = null;
        }

        $validated['is_recommended'] = $request->has('is_recommended');
        $validated['cta_text'] = $validated['cta_text'] ?? 'Hubungi Kami';
        $validated['cta_link'] = $validated['cta_link'] ?? '#';

        $schema->update($validated);

        return back()->with('success', 'Skema berhasil diperbarui');
    }

    public function destroy(Schema $schema)
    {
        $schema->orders()->update(['schema_id' => null]);
        $schema->delete();

        return back()->with('success', 'Skema berhasil dihapus.');
    }
}