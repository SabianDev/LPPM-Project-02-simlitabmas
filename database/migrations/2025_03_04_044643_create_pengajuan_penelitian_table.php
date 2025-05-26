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
        Schema::create('pengajuan_penelitian', function (Blueprint $table) {
            $table->id();
            $table->string('nidn_ketua'); // NIDN Ketua Pengusul (required)
            $table->string('jabatan'); // Pangkat/Jabatan Fungsional/Golongan (required)
            $table->string('nama_lengkap'); // Nama Lengkap dan Gelar (required)
            $table->string('prodi'); // Program Studi (required); diisi berdasarkan data dari table program_studi
            $table->string('email'); // Email (required)
            $table->string('no_wa'); // No. WhatsApp (required)
            $table->string('skema_usulan'); // Skema Usulan (required): Penelitian Dasar, Penelitian Kompetitif, atau PKM (Pemberdayaan Dasar)
            $table->string('file_proposal'); // Submit Proposal (required); menyimpan path file yang diupload
            $table->string('status')->default('Pending'); // Status, default 'Pending'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_penelitian');
    }
};
