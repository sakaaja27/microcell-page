<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Schema;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $budi = Customer::where('email', 'budi.s@example.com')->firstOrFail();
        $siti = Customer::where('email', 'siti.a@example.com')->firstOrFail();
        $sewa = Schema::where('skema', 'like', '%Sewa%')->firstOrFail();
        $beli = Schema::where('skema', 'like', '%Beli%')->firstOrFail();

        Order::insert([
            [
                'id' => 'MC001-29-2026',
                'customer_id' => $budi->id,
                'schema_id' => $sewa->id,
                'customer' => $budi->nama,
                'skema' => $sewa->skema,
                'qty' => 2,
                'total' => $sewa->harga * 2,
                'status' => 'Menunggu',
                'tanggal' => '19-Aug-2026',
                'image' => 'https://images.unsplash.com/photo-1611099687311-b1e779c67db5?w=200&h=300&fit=crop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'MC002-29-2026',
                'customer_id' => $siti->id,
                'schema_id' => $beli->id,
                'customer' => $siti->nama,
                'skema' => $beli->skema,
                'qty' => 1,
                'total' => $beli->harga * 1,
                'status' => 'Proses',
                'tanggal' => '18-Aug-2026',
                'image' => 'https://images.unsplash.com/photo-1611099687311-b1e779c67db5?w=200&h=300&fit=crop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}