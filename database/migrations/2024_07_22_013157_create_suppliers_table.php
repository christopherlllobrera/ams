<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->string('supplier_address')->nullable();
            $table->string('municipality_id')->constrained()->cascadeOnDelete()->nullable();
            $table->string('province_id')->constrained()->cascadeOnDelete()->nullable();
            $table->string('country')->nullable();
            $table->string('supplier_contact_name')->nullable();
            $table->string('supplier_contact_phone')->nullable();
            $table->string('supplier_email')->nullable();
            $table->string('supplier_website')->nullable();
            $table->string('supplier_notes')->nullable();
            $table->longText('supplier_attachment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
