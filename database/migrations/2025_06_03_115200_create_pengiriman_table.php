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
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kendaraan_id');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('rute_id');
            $table->enum('status', ['OTW', 'Selesai'])->default('OTW');
            $table->text('deskripsi_barang')->nullable();
            $table->dateTime('estimasi_kedatangan')->nullable();
            $table->dateTime('kedatangan_sebenarnya')->nullable();
            $table->timestamps(); 

            $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rute_id')->references('id')->on('rutes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
