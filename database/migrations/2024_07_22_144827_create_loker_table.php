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
        Schema::create('loker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perusahaan');
            $table->string('jabatan');
            $table->text('alamat');
            $table->enum('jenis_waktu_pekerjaan', ['Waktu Kerja Standar (Full-Time)', 'Waktu Kerja Paruh Waktu (Part-Time)', 'Waktu Kerja Fleksibel (Flexible Hours)', 'Shift Kerja (Shift Work)', 'Waktu Kerja Bergilir (Rotating Shifts)', 'Waktu Kerja Jarak Jauh (Remote Work)', 'Waktu Kerja Kontrak (Contract Work)', 'Waktu Kerja Proyek (Project-Based Work)', 'Waktu Kerja Tidak Teratur (Irregular Hours)', 'Waktu Kerja Sementara (Temporary Work)']);
            $table->text('deskripsi');
            $table->enum('status', ['Menunggu Konfirmasi', 'Dipublikasi', 'Ditolak'])->default('Menunggu Konfirmasi');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_perusahaan')->references('id')->on('perusahaan')->onDelete('cascades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loker');
    }
};
