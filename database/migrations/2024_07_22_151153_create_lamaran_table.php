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
            $table->id();
            $table->unsignedBigInteger('id_loker');
            $table->unsignedBigInteger('id_alumni');
            $table->string('file');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_loker')->references('id')->on('loker')->onDelete('cascades');
            $table->foreign('id_alumni')->references('id')->on('alumni')->onDelete('cascades');
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
