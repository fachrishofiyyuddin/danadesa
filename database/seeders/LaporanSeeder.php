<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laporan;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        Laporan::create([
            'rab_id' => 3,
            'isi_laporan' => 'Kegiatan telah selesai 100% sesuai RAB.',
            'bukti_realiasi' => 'foto_kegiatan.jpg',
            'status' => 'disetujui'
        ]);
    }
}
