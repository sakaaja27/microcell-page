<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $payments = PaymentMethod::orderBy('id')->get();

        return view('payments.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'string', 'max:50'],
            'va' => ['required', 'string', 'max:100'],
            'qr' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('qr')) {
            $validated['qr'] = $request->file('qr')->store('qr_codes', 'public');
        }

        PaymentMethod::create($validated);

        return back()->with('success', 'Metode pembayaran berhasil ditambahkan.');
    }

    public function update(Request $request, PaymentMethod $payment)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'string', 'max:50'],
            'va' => ['required', 'string', 'max:100'],
            'qr' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('qr')) {
            $validated['qr'] = $request->file('qr')->store('qr_codes', 'public');
        } else {
            unset($validated['qr']);
        }

        $payment->update($validated);

        return back()->with('success', 'Metode pembayaran berhasil diperbarui.');
    }

    public function destroy(PaymentMethod $payment)
    {
        $payment->delete();

        return back()->with('success', 'Metode pembayaran berhasil dihapus.');
    }
}