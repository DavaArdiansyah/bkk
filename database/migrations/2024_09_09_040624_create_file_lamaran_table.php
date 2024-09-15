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
        Schema::create('file_lamaran', function (Blueprint $table) {
            $table->unsignedBigInteger('id_lamaran');
            $table->string('nama_file');

            $table->foreign('id_lamaran')->references('id_lamaran')->on('lamaran')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_lamaran');
    }
};
