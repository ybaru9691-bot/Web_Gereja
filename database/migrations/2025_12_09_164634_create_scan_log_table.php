<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scan_log', function (Blueprint $table) {
            $table->id('log_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('warta_id');
            $table->dateTime('waktu_scan');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('warta_id')
                ->references('warta_id')->on('warta_jemaat')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scan_log');
    }
};
