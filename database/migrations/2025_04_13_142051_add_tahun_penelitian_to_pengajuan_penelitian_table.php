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
            $table->year('tahun_penelitian')->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_penelitian', function (Blueprint $table) {
            $table->dropColumn('tahun_penelitian');
        });
    }
};
