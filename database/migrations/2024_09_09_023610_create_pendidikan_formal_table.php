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
        Schema::create('riwayat_pendidikan_formal', function (Blueprint $table) {
            $table->string('id_riwayat_pendidikan_formal')->primary();
            $table->string('nik');
            $table->string('nama_sekolah');
            $table->text('alamat');
            $table->string('gelar')->nullable();
            $table->string('bidang_studi')->nullable();
            $table->year('tahun_awal');
            $table->year('tahun_akhir');
            $table->text('deskripsi');

            $table->foreign('nik')->references('nik')->on('data_alumni')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pendidikan_formal');
    }
};
