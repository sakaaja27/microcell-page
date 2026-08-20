<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            SchemaSeeder::class,
            CustomerSeeder::class,
            OrderSeeder::class,
            PaymentMethodSeeder::class,
            AgendaSeeder::class,
            TransactionSeeder::class,
            SchemaDistributionSeeder::class,
        ]);
    }
}