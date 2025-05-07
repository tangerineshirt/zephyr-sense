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
        Schema::create('airs', function (Blueprint $table) {
            $table->id();
            $table->float('pm25');
            $table->float('co');
            $table->float('no2');
            $table->float('temp');
            $table->float('humidity');
            $table->string('air_quality');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airs');
    }
};
