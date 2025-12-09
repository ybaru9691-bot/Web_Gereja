<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_jemaat', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_jemaat');
    }
};
