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

        $transactionData = Transaction::orderBy('id')->get(['name', 'total']);

        $schemaData = SchemaDistribution::all(['name', 'value']);

        $recentOrders = Order::with(['customer', 'schema'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $agendas = Agenda::orderBy('date')->get();

        return view('dashboard', compact(
            'metrics',
            'transactionData',
            'schemaData',
            'recentOrders',
            'agendas'
        ));
    }
}