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
        Schema::create('pengajuan_kp', function (Blueprint $table) {
            $table->id();
            $table->string('npm');
            $table->string('semester');
            $table->string('tujuan_instansi'); 
            $table->string('judul_laporan')->nullable(); // diisi saat mulai lapor judul
            $table->unsignedBigInteger('dosen_id')->nullable(); // akan diisi oleh Admin nanti
            $table->string('status')->default('Diproses'); // Diproses, Disetujui, Ditolak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kp');
    }
};
