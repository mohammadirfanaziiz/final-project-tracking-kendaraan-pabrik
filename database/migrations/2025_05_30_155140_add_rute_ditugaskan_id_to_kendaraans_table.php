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
        
        Schema::table('kendaraans', function (Blueprint $table) {
            if (!Schema::hasColumn('kendaraans', 'rute_ditugaskan_id')) {
                $table->foreignId('rute_ditugaskan_id')->nullable()->constrained('rutes')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kendaraans', function (Blueprint $table) {
        $table->dropForeign(['rute_ditugaskan_id']);
        $table->dropColumn('rute_ditugaskan_id');
        });
    }
};
