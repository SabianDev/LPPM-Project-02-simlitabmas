<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penelitian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposal_id'); // ID proposal asal (dari pengajuan_penelitian)
            $table->unsignedBigInteger('user_id');       // User yang melakukan penelitian
            $table->string('title');                     // Judul penelitian (diambil dari nama file proposal)
            $table->string('status')->default('ongoing');  // Status penelitian: ongoing atau finished
            $table->timestamps();

            // Jika perlu, tambahkan foreign key (opsional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('proposal_id')->references('id')->on('pengajuan_penelitian')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penelitian');
    }
};
