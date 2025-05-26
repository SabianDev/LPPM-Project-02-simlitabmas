<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('final_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penelitian_id');
            $table->string('final_article'); // File artikel/publikasi final
            $table->string('final_report');  // File laporan
            $table->string('final_budget');  // File anggaran
            $table->timestamps();

            $table->foreign('penelitian_id')->references('id')->on('penelitian')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('final_reports');
    }
};
