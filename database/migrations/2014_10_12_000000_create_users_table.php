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
        Schema::create('users', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('password');
            $table->enum('role', ['Admin BKK', 'Perusahaan', 'Alumni']);
            $table->string('id_data_perusahaan')->nullable();
            $table->timestamps();

            $table->foreign('id_data_perusahaan')->references('id_data_perusahaan')->on('data_perusahaan')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
