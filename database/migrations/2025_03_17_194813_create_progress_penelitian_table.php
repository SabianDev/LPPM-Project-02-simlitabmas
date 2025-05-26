<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('progress_penelitian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penelitian_id');
            $table->text('description')->nullable(); // Keterangan progress
            $table->string('file_progress');         // File dokumen progress
            $table->timestamps();

            $table->foreign('penelitian_id')->references('id')->on('penelitian')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress_penelitian');
    }
};
