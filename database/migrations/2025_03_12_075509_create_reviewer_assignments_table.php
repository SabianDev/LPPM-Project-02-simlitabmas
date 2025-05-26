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
        Schema::create('reviewer_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposal_id'); // Mengacu ke tabel pengajuan_penelitian
            $table->unsignedBigInteger('reviewer_id'); // Mengacu ke tabel users (reviewer)
            $table->string('assignment_status')->default('assigned'); // Misal: assigned, on_work, completed
            $table->timestamps();

            $table->foreign('proposal_id')
                  ->references('id')
                  ->on('pengajuan_penelitian')
                  ->onDelete('cascade');

            $table->foreign('reviewer_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviewer_assignments');
    }
};
