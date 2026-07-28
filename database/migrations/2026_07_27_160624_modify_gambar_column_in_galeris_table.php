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
        // 1. Data Migration: convert existing string to JSON array
        $galeris = \Illuminate\Support\Facades\DB::table('galeris')->whereNotNull('gambar')->get();
        foreach ($galeris as $galeri) {
            // Check if it's already a JSON array
            if (!str_starts_with($galeri->gambar, '[')) {
                \Illuminate\Support\Facades\DB::table('galeris')
                    ->where('id', $galeri->id)
                    ->update(['gambar' => json_encode([$galeri->gambar])]);
            }
        }

        // 2. Schema Migration: change column type to longText
        Schema::table('galeris', function (Blueprint $table) {
            $table->longText('gambar')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
            $table->string('gambar')->nullable()->change();
        });
    }
};
