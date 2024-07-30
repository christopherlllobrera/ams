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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('software_name');
            $table->foreignId('categories_id');//foreign key
            $table->string('product_key')->nullable();
            $table->integer('seat')->nullable();
            $table->string('company_name')->nullable();
            $table->foreignId('manufacturers_id'); //foreign key
            $table->string('license_to_name')->nullable();
            $table->string('license_to_email')->nullable();
            $table->boolean('reassignable')->nullable();
            $table->string('license_order_number')->nullable();
            $table->string('license_purchase_cost')->nullable();
            $table->string('license_purchase_date')->nullable();
            $table->string('license_expiration_date')->nullable();
            $table->string('license_termination_date')->nullable();
            $table->string('license_purchase_order_number')->nullable();
            $table->string('depreciation')->nullable();
            $table->string('maintained')->nullable();
            $table->longText('license_notes')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
