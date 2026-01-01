<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_ibadah', function (Blueprint $table) {
            $table->id('id_jadwal');

            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai')->nullable();

            $table->string('jenis_ibadah', 100);
            $table->string('lokasi', 100);
            $table->string('pelayan', 100);

            $table->text('keterangan')->nullable();

            $table->enum('status', ['aktif', 'selesai', 'batal'])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_ibadah');
    }
};
