<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaPenelitianTable extends Migration
{
    public function up()
    {
        Schema::create('anggota_penelitian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proposal')->constrained('pengajuan_penelitian')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anggota_penelitian');
    }
}
