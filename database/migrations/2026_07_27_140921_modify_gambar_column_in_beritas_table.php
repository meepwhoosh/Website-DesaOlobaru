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
        // 1. Data Migration: convert existing string (e.g. 'berita/image.jpg') to JSON array '["berita\/image.jpg"]'
        $beritas = \Illuminate\Support\Facades\DB::table('beritas')->whereNotNull('gambar')->get();
        foreach ($beritas as $berita) {
            // Check if it's already a JSON array
            if (!str_starts_with($berita->gambar, '[')) {
                \Illuminate\Support\Facades\DB::table('beritas')
                    ->where('id', $berita->id)
                    ->update(['gambar' => json_encode([$berita->gambar])]);
            }
        }

        // 2. Schema Migration: change column type to text/longText
        Schema::table('beritas', function (Blueprint $table) {
            $table->longText('gambar')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->string('gambar')->nullable()->change();
        });
    }
};
