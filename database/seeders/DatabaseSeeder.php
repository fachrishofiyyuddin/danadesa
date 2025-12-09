<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RabSeeder::class,
            DpaSeeder::class,
            SppSeeder::class,
            PembayaranSeeder::class,
            LaporanSeeder::class,
        ]);
    }
}
