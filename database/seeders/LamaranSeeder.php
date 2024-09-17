<?php

namespace Database\Seeders;

use App\Models\Lamaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LamaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lamaran::create([
            'id_lamaran' => '1',
            'id_lowongan_pekerjaan' => 'LP000001',
            'nik' => '2206510431',
            'status' => 'Diterima',
        ]);
    }
}
