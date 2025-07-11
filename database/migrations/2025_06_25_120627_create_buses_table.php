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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bus');
            $table->string('plat', 40)->unique();
            $table->string('latitude')->default('-5.132969');
            $table->string('longitude')->default('119.515476');
            $table->enum('status', ['TERSEDIA', 'FULL', 'MAINTENANCE'])->default('TERSEDIA');
            $table->foreignId('driver_id')->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            $table->foreignId('route_id')->nullable()
                  ->constrained('routes')
                  ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
