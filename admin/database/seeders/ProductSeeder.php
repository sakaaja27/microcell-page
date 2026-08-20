<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::updateOrCreate(
            ['nama' => 'Microcell'],
            [
                'spesifikasi' => 'Dual Chamber, dimensi 42 × 40 × 40 cm, sistem MFC + BPFC, terdiri dari chamber anoda dan katoda, menggunakan limbah kotoran sapi sebagai sumber energi, material acrylic, salt bridge sebagai penghubung chamber, dan dilengkapi sistem monitoring IoT.',
                'deskripsi' => 'Sistem MFC + BPFC yang memanfaatkan limbah kotoran sapi untuk menghasilkan energi listrik. Menggunakan desain dual chamber dengan ruang anoda dan katoda yang terhubung melalui salt bridge serta didukung sistem monitoring IoT.',
                'stock' => 50,
            ]
        );
    }
}