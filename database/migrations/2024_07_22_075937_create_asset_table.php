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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_tag');
            $table->string('asset_name');
            $table->string('asset_models_id')->constrained()->cascadeOnDelete()->nullable();
            $table->string('serial_number')->nullable();
            $table->string('categories_id')->nullable();
            $table->string('status_id')->nullable();//make this enum
            $table->longText('asset_note')->nullable();
            $table->string('companies_id')->constrained()->cascadeOnDelete()->nullable();
            $table->string('departments_id')->constrained()->cascadeOnDelete()->nullable();
            $table->string('project_id')->constrained()->cascadeOnDelete()->nullable();
            $table->string('locations_id')->constrained()->cascadeOnDelete()->nullable();
            $table->longText('asset_attachement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
