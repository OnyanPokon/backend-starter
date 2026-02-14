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
        Schema::create('jadwal_konselors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konselor_id')->constrained('konselors')->onDelete('cascade');
            $table->foreignId('hari_layanan_id')->constrained('hari_layanans')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['konselor_id', 'hari_layanan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_konselors');
    }
};
