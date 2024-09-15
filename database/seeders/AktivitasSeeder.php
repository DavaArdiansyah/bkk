<?php

namespace Database\Seeders;

use App\Models\Aktivitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AktivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aktivitas::create([
            'id_aktivitas_users' => 1,
            'username' => 'perusahaan@mail.com',
            'keterangan' => 'Menambahkan Informasi Lowongan Baru',
        ]);

        Aktivitas::create([
            'id_aktivitas_users' => 2,
            'username' => 'dava@mail.com',
            'keterangan' => 'Melamar Pekerjaan Yang Tersedia',
        ]);
    }
}
