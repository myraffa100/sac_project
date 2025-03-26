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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('coach_id')->constrained('coaches')->onDelete('cascade');
            $table->string('hari'); // Contoh: Senin, Selasa, dll.
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('status', ['terjadwal', 'selesai'])->default('terjadwal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
