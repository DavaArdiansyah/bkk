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
        Schema::create('pengalaman_kerja', function (Blueprint $table) {
            $table->string('id_pengalaman_kerja')->primary();
            $table->string('nik');
            $table->string('jabatan');
            $table->enum('jenis_waktu_pekerjaan', ['Waktu Kerja Standar (Full-Time)', 'Waktu Kerja Paruh Waktu (Part-Time)', 'Waktu Kerja Fleksibel (Flexible Hours)', 'Shift Kerja (Shift Work)', 'Waktu Kerja Bergilir (Rotating Shifts)', 'Waktu Kerja Jarak Jauh (Remote Work)', 'Waktu Kerja Kontrak (Contract Work)', 'Waktu Kerja Proyek (Project-Based Work)', 'Waktu Kerja Tidak Teratur (Irregular Hours)', 'Waktu Kerja Sementara (Temporary Work)']);
            $table->string('nama_perusahaan');
            $table->text('alamat');
            $table->year('tahun_awal');
            $table->year('tahun_akhir');
            $table->text('deskripsi');

            $table->foreign('nik')->references('nik')->on('data_alumni')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengalaman_kerja');
    }
};
