<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lowongan_pekerjaan', function (Blueprint $table) {
            $table->string('id_lowongan_pekerjaan')->primary();
            $table->string('id_data_perusahaan');
            $table->string('jabatan');
            $table->enum('jenis_waktu_pekerjaan', ['Waktu Kerja Standar (Full-Time)', 'Waktu Kerja Paruh Waktu (Part-Time)', 'Waktu Kerja Fleksibel (Flexible Hours)', 'Shift Kerja (Shift Work)', 'Waktu Kerja Bergilir (Rotating Shifts)', 'Waktu Kerja Jarak Jauh (Remote Work)', 'Waktu Kerja Kontrak (Contract Work)', 'Waktu Kerja Proyek (Project-Based Work)', 'Waktu Kerja Tidak Teratur (Irregular Hours)', 'Waktu Kerja Sementara (Temporary Work)']);
            $table->text('deskripsi');
            $table->timestamp('tanggal_akhir');
            $table->enum('status', ['Tertunda', 'Dipublikasi', 'Tidak Dipublikasi'])->default('Tertunda');
            $table->timestamp('waktu');

            $table->foreign('id_data_perusahaan')->references('id_data_perusahaan')->on('data_perusahaan')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_pekerjaan');
    }
};
