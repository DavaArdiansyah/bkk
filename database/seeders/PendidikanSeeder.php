<?php

namespace Database\Seeders;

use App\Models\PendidikanFormal;
use App\Models\PendidikanNonFormal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PendidikanFormal::create([
            'id_riwayat_pendidikan_formal' => 'RP000001',
            'nik' => '2206510420',
            'nama_sekolah' => 'SMPN 41 bandung',
            'alamat' => 'Bandung, Cijerah, Bandung Kulon, Kota Bandung, Jawa Barat',
            'tahun_awal' => 2019,
            'tahun_akhir' => 2022,
            'deskripsi' => 'Saya adalah lulusan covid-19',
        ]);

        PendidikanNonFormal::create([
            'id_riwayat_pendidikan_non_formal' => 'RPNF000001',
            'nik' => '2206510420',
            'nama_lembaga' => 'Nama lembaga kursus',
            'nama_kursus' => 'Nama kursus',
            'alamat' => 'Bandung, Cijerah, Bandung Kulon, Kota Bandung, Jawa Barat',
            'tanggal' => '2024-08-06',
        ]);
    }
}
