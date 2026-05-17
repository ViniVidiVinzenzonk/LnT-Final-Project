<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // bikin admin manual lewat seeder (sesuai requirement)
        User::create([
            'nama_lengkap' => 'Admin Utama',
            'name'         => 'Admin Utama',
            'email'        => 'admin@gmail.com',
            'password'     => Hash::make('admin123'),
            'no_hp'        => '081234567890',
            'role'         => 'admin',
        ]);

        // seeding kategori awal biar gak kosong pas pertama kali
        Kategori::create(['nama_kategori' => 'Elektronik']);
        Kategori::create(['nama_kategori' => 'Makanan & Minuman']);
        Kategori::create(['nama_kategori' => 'Pakaian']);
    }
}