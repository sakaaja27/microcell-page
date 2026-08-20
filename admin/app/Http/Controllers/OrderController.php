<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Schema;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'schema'])->orderBy('created_at', 'desc')->get();
        $customers = Customer::orderBy('nama')->get();
        $schemas = Schema::where('status', 'Aktif')->orderBy('skema')->get();

        return view('orders.index', compact('orders', 'customers', 'schemas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'schema_id' => ['required', 'exists:schemas,id'],
            'qty' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:Menunggu,Proses,Selesai,Dibatalkan'],
            'tanggal' => ['required', 'string', 'max:30'],
            'image' => ['nullable', 'url', 'max:500'],
        ]);

        $customer = Customer::findOrFail($validated['customer_id']);
        $schema = Schema::findOrFail($validated['schema_id']);

        $lastId = Order::orderByRaw('CAST(SUBSTRING(id, 3, 3) AS UNSIGNED) DESC')->value('id');
        $seq = $lastId ? ((int) preg_replace('/\D/', '', explode('-', $lastId)[0]) + 1) : 1;

        Order::create([
            'id' => sprintf('MC%03d-%d-%d', $seq, now()->day, now()->year),
            'customer_id' => $customer->id,
            'schema_id' => $schema->id,
            'customer' => $customer->nama,
            'skema' => $schema->skema,
            'qty' => $validated['qty'],
            'total' => $schema->harga * $validated['qty'],
            'status' => $validated['status'],
            'tanggal' => $validated['tanggal'],
            'image' => $validated['image'] ?? null,
        ]);

        return back()->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'schema_id' => ['required', 'exists:schemas,id'],
            'qty' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:Menunggu,Proses,Selesai,Dibatalkan'],
            'tanggal' => ['required', 'string', 'max:30'],
            'image' => ['nullable', 'url', 'max:500'],
        ]);

        $customer = Customer::findOrFail($validated['customer_id']);
        $schema = Schema::findOrFail($validated['schema_id']);

        $order->update([
            'customer_id' => $customer->id,
            'schema_id' => $schema->id,
            'customer' => $customer->nama,
            'skema' => $schema->skema,
            'qty' => $validated['qty'],
            'total' => $schema->harga * $validated['qty'],
            'status' => $validated['status'],
            'tanggal' => $validated['tanggal'],
            'image' => $validated['image'] ?? $order->image,
        ]);

        if ($validated['status'] === 'Selesai' && $order->schema && stripos($order->schema->satuan, 'bulan') !== false) {
            $subscription = \App\Models\Subscription::where('customer_id', $order->customer_id)
                ->where('schema_id', $order->schema_id)
                ->first();

            if ($subscription) {
                if ($subscription->order_id !== $order->id && $subscription->status !== 'Selesai') {
                    $subscription->paid_months += 1;
                    $subscription->next_billing_date = \Carbon\Carbon::parse($subscription->next_billing_date)->addMonth();
                    $subscription->order_id = $order->id;
                    
                    if ($subscription->paid_months >= $subscription->total_months) {
                        $subscription->status = 'Selesai';
                    }
                    $subscription->save();
                }
            } else {
                $beliSchema = \App\Models\Schema::where('skema', 'like', '%Beli%')->first();
                $hargaUnit = $beliSchema ? $beliSchema->harga : 6000000;
                $hargaSewa = $order->schema->harga;
                $totalMonths = ceil($hargaUnit / $hargaSewa);

                \App\Models\Subscription::create([
                    'customer_id' => $order->customer_id,
                    'schema_id' => $order->schema_id,
                    'order_id' => $order->id,
                    'status' => 'Aktif',
                    'started_at' => now(),
                    'next_billing_date' => now()->addMonth(),
                    'paid_months' => 1,
                    'total_months' => $totalMonths
                ]);
            }
        }

        return back()->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Menunggu,Proses,Selesai,Dibatalkan'],
        ]);

        $order->update(['status' => $validated['status']]);

        if ($validated['status'] === 'Selesai' && $order->schema && stripos($order->schema->satuan, 'bulan') !== false) {
            $subscription = \App\Models\Subscription::where('customer_id', $order->customer_id)
                ->where('schema_id', $order->schema_id)
                ->first();

            if ($subscription) {
                if ($subscription->order_id !== $order->id && $subscription->status !== 'Selesai') {
                    $subscription->paid_months += 1;
                    $subscription->next_billing_date = \Carbon\Carbon::parse($subscription->next_billing_date)->addMonth();
                    $subscription->order_id = $order->id;
                    
                    if ($subscription->paid_months >= $subscription->total_months) {
                        $subscription->status = 'Selesai';
                    }
                    $subscription->save();
                }
            } else {
                $beliSchema = \App\Models\Schema::where('skema', 'like', '%Beli%')->first();
                $hargaUnit = $beliSchema ? $beliSchema->harga : 6000000;
                $hargaSewa = $order->schema->harga;
                $totalMonths = ceil($hargaUnit / $hargaSewa);

                \App\Models\Subscription::create([
                    'customer_id' => $order->customer_id,
                    'schema_id' => $order->schema_id,
                    'order_id' => $order->id,
                    'status' => 'Aktif',
                    'started_at' => now(),
                    'next_billing_date' => now()->addMonth(),
                    'paid_months' => 1,
                    'total_months' => $totalMonths
                ]);
            }
        }

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return back()->with('success', 'Pesanan berhasil dihapus.');
    }
}