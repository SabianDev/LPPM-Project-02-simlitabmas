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
        Schema::create('reviewer_status', function (Blueprint $table) {
            $table->id();
            // Kolom user_id sebagai foreign key ke tabel users
            $table->unsignedBigInteger('user_id');
            $table->string('status')->default('available'); // "available" atau "on_work"
            // Optional: jika kamu ingin menyimpan id proposal yang sedang di-review, tambahkan kolom proposal_id
            // $table->unsignedBigInteger('proposal_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Jika menggunakan proposal_id, bisa tambahkan foreign key ke tabel pengajuan_penelitian
            // $table->foreign('proposal_id')->references('id')->on('pengajuan_penelitian')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviewer_status');
    }
};
