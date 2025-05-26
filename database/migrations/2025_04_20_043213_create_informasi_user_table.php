<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('informasi_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nidn')->nullable();
            $table->string('nama')->nullable();
            $table->string('prodi')->nullable();
            $table->string('jenjang_pendidikan')->nullable();
            $table->string('jabatan_akademik')->nullable();
            $table->string('bidang_ilmu')->nullable();
            $table->decimal('sinta_score_overall', 8, 2)->nullable();
            $table->decimal('sinta_score_3_years', 8, 2)->nullable();
            $table->string('alamat')->nullable();
            $table->string('ttl')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('web_personal')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_user');
    }
};
