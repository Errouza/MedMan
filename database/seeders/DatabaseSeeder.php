<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Administrator Klinik',
            'email' => 'admin@klinik.com',
            'password' => bcrypt('admin123'), // Password harus di-hash
            'phone' => '081234567890',
            'role' => 'admin',
        ]);

        // 2. Buat Akun Dokter
        $userDokter = User::create([
            'name' => 'dr. Budi Santoso',
            'email' => 'dokter@klinik.com',
            'password' => bcrypt('dokter123'),
            'phone' => '089876543210',
            'role' => 'doctor',
        ]);

        // 3. Masukkan data detail Dokter yang berelasi dengan Akun User di atas
        // Asumsi Primary Key di tabel users adalah 'id' (standar Laravel)
        Doctor::create([
            'user_id' => $userDokter->user_id, // Mengambil ID dari akun dokter yang baru dibuat
            'sip_number' => 'SIP.12345.67890.2026',
            'specialization' => 'Dokter Umum',
        ]);
    }
}
