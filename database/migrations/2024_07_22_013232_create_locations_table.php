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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('location_name');
            $table->string('parent_location')->nullable();
            $table->string('location_address')->nullable();
            $table->string('municipality_id')->constraint()->cascadeOnDelete();
            $table->string('province_id')->constraint()->cascadeOnDelete();
            $table->string('region_id')->constraint()->cascadeOnDelete();
            $table->string('location_country')->nullable();
            $table->string('location_zip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
