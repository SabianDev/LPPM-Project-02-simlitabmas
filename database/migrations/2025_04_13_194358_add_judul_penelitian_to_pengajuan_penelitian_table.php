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
        Schema::table('pengajuan_penelitian', function (Blueprint $table) {
            $table->string('judul_penelitian')->after('tahun_penelitian');
        });
    }

    public function down()
    {
        Schema::table('pengajuan_penelitian', function (Blueprint $table) {
            $table->dropColumn('judul_penelitian');
        });
    }

};
