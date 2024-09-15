<?php

namespace Database\Seeders;

use App\Models\Alumni;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'adminbkk@gmail.com',
            'password' => 'adminbkk',
            'role' => 'Admin BKK',
        ]);

        User::create([
            'username' => 'perusahaan@gmail.com',
            'password' => 'perusahaan',
            'role' => 'Perusahaan',
        ]);

        Perusahaan::create([
            'id_data_perusahaan' => 'P000001',
            'username' => 'perusahaan@gmail.com',
            'nama' => 'Perusahaan',
            'bidang_usaha' => 'Bidang Teknologi, Informasi, dan Komunikasi',
            'no_telepon' => '123456789',
            'alamat' => 'Bandung, Cijerah, Bandung Kulon, Kota Bandung, Jawa Barat',
            'status' => 'Aktif',
        ]);

        User::create([
            'username' => 'dava@mail.com',
            'password' => 'dava123',
            'role' => 'Alumni'
        ]);

        Alumni::create([
            'nik' => '2206510420',
            'username' => 'dava123',
            'nama' => 'Dava Ardiansyah Hidayat',
            'jurusan' => 'RPL',
            'jenis_kelamin' => 'Laki Laki',
            'tahun_lulus' => 2025,
            'alamat' => 'Bandung, Cijerah, Bandung Kulon, Kota Bandung, Jawa Barat',
            'kontak' => '12345678',
        ]);
    }
}
