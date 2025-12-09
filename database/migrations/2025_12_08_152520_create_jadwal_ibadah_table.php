<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_ibadah', function (Blueprint $table) {
            $table->id('id_jadwal'); // Primary Key custom name
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_ibadah');
    }
};
