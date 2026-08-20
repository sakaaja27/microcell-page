<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $months = [
            'Jan' => 4000,
            'Feb' => 3000,
            'Mar' => 5000,
            'Apr' => 4500,
            'May' => 6000,
            'Jun' => 5500,
            'Jul' => 7000,
            'Aug' => 8000,
            'Sep' => 7500,
            'Oct' => 8500,
            'Nov' => 9000,
            'Dec' => 10000,
        ];

        foreach ($months as $name => $total) {
            Transaction::create([
                'name' => $name,
                'total' => $total,
            ]);
        }
    }
}