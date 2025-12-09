<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Kepala Seksi / Kaur',
            'email' => 'kaur@example.com',
            'role' => 'kaur',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Sekretaris Desa',
            'email' => 'sekdes@example.com',
            'role' => 'sekdes',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Kaur Keuangan / Bendahara',
            'email' => 'bendahara@example.com',
            'role' => 'bendahara',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Kepala Desa',
            'email' => 'kepala@example.com',
            'role' => 'kepala_desa',
            'password' => Hash::make('password')
        ]);
    }
}
