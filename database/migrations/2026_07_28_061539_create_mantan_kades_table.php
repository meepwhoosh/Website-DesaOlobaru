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
        Schema::create('mantan_kades', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('masa_jabatan')->nullable(); // e.g. "Tahun 1966 s/d 1971"
            $table->string('status')->nullable(); // e.g. "Pejabat Sementara"
            $table->string('foto')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantan_kades');
    }
};
