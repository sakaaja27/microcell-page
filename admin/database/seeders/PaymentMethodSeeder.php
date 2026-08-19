<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        PaymentMethod::insert([
            [
                'nama' => 'BCA Virtual Account',
                'jenis' => 'Transfer bank',
                'va' => '014 8392 8392',
                'qr' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'QRIS Merchant Microcell',
                'jenis' => 'Qris',
                'va' => '-',
                'qr' => 'https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Gopay',
                'jenis' => 'e wallet',
                'va' => '081234567890',
                'qr' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bayar di Tempat (COD/Instalasi)',
                'jenis' => 'tunai',
                'va' => '-',
                'qr' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}