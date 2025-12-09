<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dpa;

class DpaSeeder extends Seeder
{
    public function run(): void
    {
        Dpa::create([
            'rab_id' => 3,
            'nomor_dpa' => 'DPA-2024-001',
            'tanggal_diterbitkan' => now(),
        ]);
    }
}
