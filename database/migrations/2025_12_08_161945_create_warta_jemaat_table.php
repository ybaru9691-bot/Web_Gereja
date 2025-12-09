<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warta_jemaat', function (Blueprint $table) {
            $table->id('warta_id');
            $table->string('judul');
            $table->date('tanggal');
            $table->text('isi_warta')->nullable();
            $table->string('file_path')->nullable();
            $table->string('qr_code')->nullable();

            // Foreign key to users
            $table->unsignedBigInteger('dibuat_oleh');
            $table->foreign('dibuat_oleh')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warta_jemaat');
    }
};
