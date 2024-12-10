<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('license_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('licenses_id')->nullable()->constrained('licenses')->cascadeOnDelete();
            $table->string('personnel_no');
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('department_id')->nullable();
            $table->string('cost_center')->nullable();
            $table->string('project_id')->nullable();
            $table->string('wbs')->nullable();
            $table->string('seat_used')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('license_users');
    }
};
