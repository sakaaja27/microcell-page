<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $payments = [
            [
                'nama' => 'BCA Virtual Account',
                'jenis' => 'Transfer bank',
                'va' => '014 8392 8392',
                'qr' => null,
            ],
            [
                'nama' => 'QRIS Merchant Microcell',
                'jenis' => 'Qris',
                'va' => '-',
                'qr' => 'https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg',
            ],
            [
                'nama' => 'Gopay',
                'jenis' => 'e wallet',
                'va' => '081234567890',
                'qr' => null,
            ],
            [
                'nama' => 'Bayar di Tempat (COD/Instalasi)',
                'jenis' => 'tunai',
                'va' => '-',
                'qr' => null,
            ]
        ];

        foreach ($payments as $payment) {
            PaymentMethod::updateOrCreate(['nama' => $payment['nama']], $payment);
        }
    }
}