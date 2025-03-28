<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('coach_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coach_id')->constrained('coaches')->onDelete('cascade');
            $table->text('hari'); // Ubah dari string ke text atau json
            $table->string('sesi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coach_schedules');
    }
};
