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
        Schema::create('data_alumni', function (Blueprint $table) {
            $table->string('nik')->primary();
            $table->string('username');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki Laki', 'Perempuan']);
            $table->enum('jurusan', ['AK', 'BR', 'DKV', 'MLOG', 'MP', 'RPL', 'TKJ']);
            $table->year('tahun_lulus');
            $table->text('alamat')->nullable();
            $table->string('kontak')->nullable();
            $table->string('keahlian')->nullable();
            $table->string('nama_file_foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['Tidak Bekerja', 'Bekerja', 'Wirausaha', 'Kuliah'])->default('Tidak Bekerja');

            $table->foreign('username')->references('username')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_alumni');
    }
};
