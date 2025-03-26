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
    Schema::table('schedules', function (Blueprint $table) {
        $table->string('sesi')->default('Sore')->after('status');
    });
}

public function down()
{
    Schema::table('schedules', function (Blueprint $table) {
        $table->dropColumn('sesi');
    });
}

};
