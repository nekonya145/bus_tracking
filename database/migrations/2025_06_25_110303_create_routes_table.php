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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('nama_rute')->unique();
            $table->string('sekolah_latitude');
            $table->string('sekolah_longitude');
            $table->string('p1_latitude');
            $table->string('p1_longitude');
            $table->string('p2_latitude');
            $table->string('p2_longitude');
            $table->string('p3_latitude');
            $table->string('p3_longitude');
            $table->time('time_start');
            $table->time('time_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
