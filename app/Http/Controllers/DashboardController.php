<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Order;
use App\Models\SchemaDistribution;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $metrics = (object) DB::table('v_dashboard_metrics')->first();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $monthlyTotals = array_fill(0, 12, 0);

        $orders = DB::table('orders')
            ->where('status', 'Selesai')
            ->whereYear('created_at', date('Y'))
            ->selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->groupBy('month')
            ->get();

        foreach ($orders as $order) {
            $monthlyTotals[$order->month - 1] = (float) $order->total;
        }

        $transactionData = collect();
        foreach ($months as $index => $month) {
            $transactionData->push((object)[
                'name' => $month,
                'total' => $monthlyTotals[$index]
            ]);
        }

        $schemaData = DB::table('v_order_details')
            ->where('status', 'Selesai')
            ->select('skema_name as name', DB::raw('count(*) as value'))
            ->groupBy('skema_name')
            ->get();

        if ($schemaData->isEmpty()) {
            $schemaData = collect([
                (object)['name' => 'Belum ada transaksi selesai', 'value' => 1]
            ]);
        }
        $recentOrders = Order::with(['customer', 'schema'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $agendas = Agenda::orderBy('date', 'desc')->limit(5)->get();

        return view('dashboard', compact(
            'metrics',
            'transactionData',
            'schemaData',
            'recentOrders',
            'agendas'
        ));
    }
}