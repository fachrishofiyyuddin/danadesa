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
        Schema::create('spps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rab_id')->constrained()->cascadeOnDelete();
            $table->string('nomor_spp')->nullable();
            $table->decimal('jumlah_diminta', 15, 2);
            $table->enum('status', ['menunggu_verifikasi', 'ditolak', 'disetujui'])->default('menunggu_verifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spps');
    }
};
