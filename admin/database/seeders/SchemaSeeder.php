<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schema;

class SchemaSeeder extends Seeder
{
    public function run(): void
    {
        $schemas = [
            [
                'skema' => 'Sewa Unit MicroCell',
                'harga' => 700000,
                'satuan' => '/ bulan',
                'subtitle' => 'Tanpa modal besar di awal',
                'badge' => 'Sewa Alat',
                'icon' => 'refresh-cw',
                'features' => json_encode(["Tidak perlu membeli unit secara penuh", "Perangkat tetap dirawat dan dikelola tim kami", "Cocok untuk peternak yang ingin coba dulu", "Kontrak fleksibel sesuai kebutuhan", "Termasuk instalasi awal dan pendampingan"]),
                'is_recommended' => 0,
                'cta_text' => 'Hubungi Kami',
                'cta_link' => '#',
                'status' => 'Aktif',
            ],
            [
                'skema' => 'Layanan Instalasi & After-Sales Service',
                'harga' => 300000,
                'satuan' => '/ kunjungan servis',
                'subtitle' => null,
                'badge' => 'Untuk Semua Pembeli & Penyewa',
                'icon' => 'wrench',
                'features' => json_encode(["Tersedia untuk seluruh pengguna unit MicroCell", "Kunjungan teknisi prioritas ke lokasi", "Cek dan penggantian komponen", "Laporan kondisi sistem setiap kunjungan"]),
                'is_recommended' => 1,
                'cta_text' => 'Hubungi Kami',
                'cta_link' => '#',
                'status' => 'Aktif',
            ],
            [
                'skema' => 'Beli Unit MicroCell',
                'harga' => 6000000,
                'satuan' => '/ unit · bayar tunai',
                'subtitle' => 'Kepemilikan penuh, sekali bayar',
                'badge' => 'B2C Peternak',
                'icon' => 'paw-print',
                'features' => json_encode(["Unit MicroCell menjadi milik Anda sepenuhnya", "Target: peternak sapi skala 10-100 ekor", "Garansi hardware 1 tahun", "Instalasi awal termasuk dalam paket", "Pendampingan teknis di awal penggunaan"]),
                'is_recommended' => 0,
                'cta_text' => 'Beli Sekarang',
                'cta_link' => '#',
                'status' => 'Aktif',
            ]
        ];

        foreach ($schemas as $schema) {
            Schema::updateOrCreate(['skema' => $schema['skema']], $schema);
        }
    }
}