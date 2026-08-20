<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        Agenda::insert([
            [
                'title' => 'Instalasi Server Klien A',
                'date' => '20-Aug-2026',
                'time' => '09:00 WIB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Maintenance Berkala',
                'date' => '22-Aug-2026',
                'time' => '13:00 WIB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Meeting Vendor',
                'date' => '25-Aug-2026',
                'time' => '10:00 WIB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}