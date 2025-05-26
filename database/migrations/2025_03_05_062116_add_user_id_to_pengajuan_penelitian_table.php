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
        Schema::table('pengajuan_penelitian', function (Blueprint $table) {
            // Tambahkan kolom user_id; jika data sudah ada, kamu bisa membuatnya nullable terlebih dahulu
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            // Tambahkan foreign key constraint jika kolom sudah ada nilainya dan nanti diupdate menjadi non-nullable
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_penelitian', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
