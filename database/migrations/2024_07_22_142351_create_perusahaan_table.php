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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengguna');
            $table->string('nama');
            $table->string('bidang_usaha');
            $table->string('no_telepon');
            $table->text('alamat');
            $table->string('logo');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_pengguna')->references('id')->on('pengguna')->onDelete('cascades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
