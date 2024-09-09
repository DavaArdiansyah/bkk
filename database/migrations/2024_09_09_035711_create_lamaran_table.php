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
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id('id_lamaran');
            $table->string('id_lowongan_pekerjaan');
            $table->string('nik');
            $table->enum('status', ['Terkirim', 'Lolos Ketahap Selanjutnya', 'Diterima', 'Ditolak'])->default('Terkirim');
            $table->timestamps();

            $table->foreign('id_lowongan_pekerjaan')->references('id_lowongan_pekerjaan')->on('lowongan_pekerjaan')->onUpdate('cascade');
            $table->foreign('nik')->references('nik')->on('data_alumni')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamaran');
    }
};
