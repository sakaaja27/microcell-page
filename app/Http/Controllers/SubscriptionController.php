<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Order;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with(['customer', 'schema', 'order'])->orderBy('next_billing_date', 'asc')->paginate(10);
        return view('subscriptions.index', compact('subscriptions'));
    }

    public function createBill(Subscription $subscription)
    {
        // Prevent double billing if there is already an active 'Menunggu' order for this subscription.
        // For simplicity, we just check if the last order was already paid, but let's just create the bill.
        
        $customer = $subscription->customer;
        $schema = $subscription->schema;

        $lastId = Order::orderByRaw('CAST(SUBSTRING(id, 3, 3) AS UNSIGNED) DESC')->value('id');
        $seq = $lastId ? ((int) preg_replace('/\D/', '', explode('-', $lastId)[0]) + 1) : 1;
        $orderId = sprintf('MC%03d-%d-%d', $seq, now()->day, now()->year);

        // We use the qty from the original order if it exists, otherwise default to 1.
        $qty = $subscription->order ? $subscription->order->qty : 1;
        
        $order = Order::create([
            'id' => $orderId,
            'customer_id' => $customer->id,
            'schema_id' => $schema->id,
            'payment_method_id' => $subscription->order ? $subscription->order->payment_method_id : null,
            'customer' => $customer->nama,
            'skema' => $schema->skema,
            'qty' => $qty,
            'total' => $schema->harga * $qty,
            'status' => 'Menunggu',
            'tanggal' => now()->format('Y-m-d'),
        ]);

        // We update the subscription's order_id to this new bill
        // So when it is paid, it will update next_billing_date from this new order.
        $subscription->update([
            'order_id' => $order->id,
        ]);

        return back()->with('success', 'Tagihan bulan selanjutnya berhasil dibuat. Menunggu pembayaran pelanggan.');
    }
}
