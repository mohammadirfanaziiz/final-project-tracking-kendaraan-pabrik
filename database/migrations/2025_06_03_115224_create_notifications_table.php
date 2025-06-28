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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->text('pesan');
            $table->unsignedBigInteger('penerima_id');
            $table->enum('jenis', ['keterlambatan', 'penyimpangan rute']);
            $table->timestamp('waktu_dibuat')->useCurrent();
            $table->foreign('penerima_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
