<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Spp;

class SppSeeder extends Seeder
{
    public function run(): void
    {
        Spp::create([
            'rab_id' => 3,
            'nomor_spp' => 'SPP-2024-001',
            'jumlah_diminta' => 5000000,
            'status' => 'menunggu_verifikasi'
        ]);

        Spp::create([
            'rab_id' => 3,
            'nomor_spp' => 'SPP-2024-002',
            'jumlah_diminta' => 7000000,
            'status' => 'disetujui'
        ]);
    }
}
