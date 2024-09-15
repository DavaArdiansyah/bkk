<?php

namespace Database\Seeders;

use App\Models\Loker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Loker::create([
            'id_lowongan_pekerjaan' => 'LP000001',
            'id_data_perusahaan' => 'P000001',
            'jabatan' => 'Software Engineer',
            'jenis_waktu_pekerjaan' => 'Waktu Kerja Jarak Jauh (Remote Work)',
            'deskripsi' => 'Deskripsi software engineer',
            'tanggal_akhir' => '2024-08-06',
            'status' => 'Dipublikasi',
        ]);
    }
}
