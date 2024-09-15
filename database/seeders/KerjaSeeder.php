<?php

namespace Database\Seeders;

use App\Models\Kerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kerja::create([
            'id_pengalaman_kerja' => 'PK000001',
            'nik' => '2206510420',
            'jabatan' => 'Software Engineer',
            'jenis_waktu_pekerjaan' => 'Waktu Kerja Jarak Jauh (Remote Work)',
            'nama_perusahaan' => 'Perusahaan',
            'alamat' => 'Bandung, Cijerah, Bandung Kulon, Kota Bandung, Jawa Barat',
            'tahun_awal' => 2022,
            'tahun_akhir' => 2024,
            'deskripsi' => 'Saya bekerja sebagai Software Engineer',
        ]);
    }
}
