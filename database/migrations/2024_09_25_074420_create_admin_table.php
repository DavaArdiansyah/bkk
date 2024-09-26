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
        Schema::create('data_admin', function (Blueprint $table) {
            $table->string('nip')->primary();
            $table->string('username');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki Laki', 'Perempuan']);
            $table->text('alamat');
            $table->string('kontak');
            $table->string('nama_file_foto');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');

            $table->foreign('username')->references('username')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_admin');
    }
};
