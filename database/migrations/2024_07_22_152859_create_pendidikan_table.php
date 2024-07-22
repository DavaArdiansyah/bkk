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
        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_alumni');
            $table->string('nama_lembaga');
            $table->text('alamat');
            $table->string('gelar');
            $table->string('bidang_studi');
            $table->year('tahun_awal');
            $table->year('tahun_akhir');
            $table->float('nilai');
            $table->text('pengalaman_organisasi');
            $table->text('deskripsi');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_alumni')->references('id')->on('alumni')->onDelete('cascades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan');
    }
};
