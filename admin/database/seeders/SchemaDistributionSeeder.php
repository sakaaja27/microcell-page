<?php

namespace Database\Seeders;

use App\Models\SchemaDistribution;
use Illuminate\Database\Seeder;

class SchemaDistributionSeeder extends Seeder
{
    public function run(): void
    {
        SchemaDistribution::insert([
            ['name' => 'Sewa Unit', 'value' => 400, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pembelian Langsung', 'value' => 300, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Layanan Instalasi', 'value' => 300, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}