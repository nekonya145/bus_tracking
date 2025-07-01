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
            $table->decimal('sekolah_latitude', 10, 7)->default('-5.136723');
            $table->decimal('sekolah_longitude', 10, 7)->default('119.514976');
            $table->text('nama_halte1');
            $table->text('nama_halte2');
            $table->text('nama_halte3');
            $table->decimal('p1_latitude', 10, 7);
            $table->decimal('p1_longitude', 10, 7);
            $table->decimal('p2_latitude', 10, 7);
            $table->decimal('p2_longitude', 10, 7);
            $table->decimal('p3_latitude', 10, 7);
            $table->decimal('p3_longitude', 10, 7);
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
