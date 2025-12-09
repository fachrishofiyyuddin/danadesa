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
        Schema::create('rabs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // pembuat
            $table->string('nama_kegiatan');
            $table->longText('deskripsi')->nullable();
            $table->decimal('jumlah_anggaran', 15, 2);
            $table->enum('status', [
                'draft',
                'cek_sekdes',
                'cek_bendahara',
                'cek_kades',
                'ditolak',
                'disetujui'
            ])->default('draft');
            $table->text('catatan_koreksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rabs');
    }
};
