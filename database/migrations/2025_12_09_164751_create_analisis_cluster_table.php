<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analisis_cluster', function (Blueprint $table) {
            $table->id('cluster_id'); // Primary Key custom name
            $table->unsignedBigInteger('user_id'); // FK ke users
            $table->unsignedBigInteger('warta_id'); // FK ke warta_jemaat
            $table->string('cluster_label'); // Hasil cluster (A, B, C...) atau numeric
            $table->date('tanggal_analisis'); // Kapan cluster dibuat
            $table->timestamps();

            // Foreign Key Relations
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
        Schema::dropIfExists('analisis_cluster');
    }
};
