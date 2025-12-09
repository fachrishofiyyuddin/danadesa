<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        Pembayaran::create([
            'spp_id' => 2,
            'tanggal' => now(),
            'jumlah_dibayar' => 7000000,
            'metode' => 'Transfer Bank',
            'bukti' => 'bukti_transfer.jpg'
        ]);
    }
}
