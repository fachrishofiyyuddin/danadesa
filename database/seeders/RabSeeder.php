<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rab;

class RabSeeder extends Seeder
{
    public function run(): void
    {
        Rab::create([
            'user_id' => 1,
            'nama_kegiatan' => 'Pembangunan Jalan Desa',
            'deskripsi' => 'RAB pembangunan jalan desa RT 02',
            'jumlah_anggaran' => 25000000,
            'status' => 'draft',
        ]);

        Rab::create([
            'user_id' => 1,
            'nama_kegiatan' => 'Pengadaan Meja Belajar',
            'deskripsi' => 'Pengadaan 50 meja untuk balai desa',
            'jumlah_anggaran' => 12000000,
            'status' => 'cek_sekdes',
        ]);

        Rab::create([
            'user_id' => 1,
            'nama_kegiatan' => 'Renovasi Posyandu',
            'deskripsi' => 'Renovasi bangunan posyandu desa',
            'jumlah_anggaran' => 18000000,
            'status' => 'disetujui',
        ]);

        Rab::create([
            'user_id' => 1,
            'nama_kegiatan' => 'Pengadaan Komputer',
            'deskripsi' => 'Pembelian 3 komputer kantor desa',
            'jumlah_anggaran' => 15000000,
            'status' => 'ditolak',
            'catatan_koreksi' => 'Spesifikasi tidak sesuai kebutuhan'
        ]);

        Rab::create([
            'user_id' => 1,
            'nama_kegiatan' => 'Pembangunan Jembatan',
            'deskripsi' => 'RAB pembangunan jembatan desa',
            'jumlah_anggaran' => 30000000,
            'status' => 'cek_bendahara',
        ]);

        Rab::create([
            'user_id' => 1,
            'nama_kegiatan' => 'Renovasi Balai Desa',
            'deskripsi' => 'Renovasi balai desa utama',
            'jumlah_anggaran' => 22000000,
            'status' => 'cek_kades',
        ]);
    }
}
