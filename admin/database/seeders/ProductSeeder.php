<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'nama' => 'Microcell Tower Type A',
                'spesifikasi' => 'Tinggi 20m, Beban 500kg, Galvanis',
                'deskripsi' => 'Tower microcell standar untuk area perkotaan padat penduduk.',
                'stock' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Microcell Pole Type B',
                'spesifikasi' => 'Tinggi 15m, Beban 300kg, Monopole',
                'deskripsi' => 'Tiang monopole estetis untuk area perumahan.',
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Smart Pole Type C',
                'spesifikasi' => 'Tinggi 10m, Terintegrasi CCTV & Lampu',
                'deskripsi' => 'Smart pole multifungsi untuk smart city.',
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}