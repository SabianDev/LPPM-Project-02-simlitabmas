<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('anggota_penelitian_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proposal'); // Relasi dengan pengajuan_penelitian
            $table->string('npm_nama_mahasiswa'); // Format gabungan NPM dan Nama
            $table->timestamps();

            // Foreign key ke pengajuan_penelitian
            $table->foreign('id_proposal')->references('id')->on('pengajuan_penelitian')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('anggota_penelitian_mahasiswa');
    }

};
