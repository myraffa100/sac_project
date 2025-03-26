<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn(['jam_mulai', 'jam_selesai']);
        });
    }

    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
        });
    }
};
