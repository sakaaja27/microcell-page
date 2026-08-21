<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request, Schema $schema)
    {
        if ($schema->status !== 'Aktif') {
            return redirect('/')->with('error', 'Skema tidak aktif.');
        }

        $paymentMethods = PaymentMethod::all();
        
        $subscription = null;
        if ($request->has('subscription_id')) {
            $subscription = \App\Models\Subscription::find($request->input('subscription_id'));
        }

        $availableStock = \App\Models\Product::first()->stock ?? 0;
        
        return view('customer.checkout', compact('schema', 'paymentMethods', 'subscription', 'availableStock'));
    }

    public function store(Request $request, Schema $schema)
    {
        if ($schema->status !== 'Aktif') {
            return redirect('/')->with('error', 'Skema tidak aktif.');
        }

        $validated = $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
            'duration' => ['nullable', 'integer', 'min:1'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $user = Auth::user();
        $customer = $user->customer;

        if (!$customer) {
            // Fallback just in case they don't have customer profile yet
            $customer = \App\Models\Customer::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
                'phone' => '0000000000',
            ]);
        }

        $path = $request->file('image')->store('bukti', 'public');
        $imageUrl = asset('storage/' . $path);

        $subscriptionId = $request->input('subscription_id');
        $isPreorder = $request->input('is_preorder', 0) == 1;
        $isStockDeducted = false;

        $product = \App\Models\Product::first();
        if (!$subscriptionId && $product && stripos($schema->skema, 'Unit') !== false) {
            if (!$isPreorder) {
                if ($product->stock < $validated['qty']) {
                    return back()->withInput()->with('error', 'Maaf, stok produk tidak mencukupi (Tersisa: ' . $product->stock . '). Silakan tunggu restock.');
                }
                // Deduct stock
                $product->decrement('stock', $validated['qty']);
                $isStockDeducted = true;
            }
        } else {
            // Not a unit schema, no stock deduction needed ever
            $isStockDeducted = true;
            $isPreorder = false;
        }

        $lastId = Order::orderByRaw('CAST(SUBSTRING(id, 3, 3) AS UNSIGNED) DESC')->value('id');
        $seq = $lastId ? ((int) preg_replace('/\D/', '', explode('-', $lastId)[0]) + 1) : 1;

        $duration = $request->input('duration', null);
        $totalHarga = $schema->harga * $validated['qty'];

        Order::create([
            'id' => sprintf('MC%03d-%d-%d', $seq, now()->day, now()->year),
            'customer_id' => $customer->id,
            'schema_id' => $schema->id,
            'payment_method_id' => $validated['payment_method_id'],
            'customer' => $customer->nama,
            'skema' => $schema->skema,
            'qty' => $validated['qty'],
            'duration' => $duration,
            'total' => $totalHarga,
            'status' => 'Menunggu',
            'tanggal' => now()->format('Y-m-d'),
            'image' => $imageUrl,
            'is_preorder' => $isPreorder,
            'is_stock_deducted' => $isStockDeducted,
        ]);

        return redirect()->route('customer.history')->with('success', 'Pesanan berhasil dibuat. Kami akan segera memprosesnya.');
    }

    public function history()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect('/admin');
        }
        
        $customer = $user->customer;
        $orders = $customer ? Order::with(['schema', 'paymentMethod'])->where('customer_id', $customer->id)->orderBy('created_at', 'desc')->get() : collect();

        return view('customer.history', compact('orders'));
    }
}
