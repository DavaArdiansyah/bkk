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
        Schema::create('data_perusahaan', function (Blueprint $table) {
            $table->string('id_data_perusahaan')->primary();
            $table->string('username');
            $table->string('nama');
            $table->string('bidang_usaha');
            $table->string('no_telepon');
            $table->text('alamat');
            $table->string('nama_file_logo');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Tidak Aktif');

            $table->foreign('username')->references('username')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_perusahaan');
    }
};
