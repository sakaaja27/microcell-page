<?php

namespace Database\Seeders;

use App\Models\Schema;
use Illuminate\Database\Seeder;

class SchemaSeeder extends Seeder
{
    public function run(): void
    {
        Schema::insert([
            [
                'skema' => 'Sewa Unit Tahunan',
                'harga' => 7500000,
                'satuan' => 'Per Tahun',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skema' => 'Sewa Unit Bulanan',
                'harga' => 700000,
                'satuan' => 'Per Bulan',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skema' => 'Pembelian Langsung',
                'harga' => 35000000,
                'satuan' => 'Sekali Bayar',
                'status' => 'Tidak Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}