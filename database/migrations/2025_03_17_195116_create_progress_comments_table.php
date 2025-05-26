<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('progress_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('progress_id');
            $table->unsignedBigInteger('user_id'); // user yang memberikan komentar
            $table->text('comment');
            $table->timestamps();

            $table->foreign('progress_id')->references('id')->on('progress_penelitian')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress_comments');
    }
};
