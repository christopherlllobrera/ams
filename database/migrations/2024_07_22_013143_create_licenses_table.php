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
            $table->string('software_name')->nullable();
            $table->string('categories_id')->nullable();//foreign key
            $table->string('product_key')->nullable();
            $table->string('seat')->nullable();
            $table->string('supplier_id')->nullable();
            $table->string('manufacturer_id')->nullable(); //foreign key
            $table->string('registered_name')->nullable();
            $table->string('registered_email')->nullable();
            $table->string('license_order_number')->nullable();
            $table->string('license_purchase_cost')->nullable();
            $table->date('license_purchase_date')->nullable();
            $table->date('license_expiration_date')->nullable();
            $table->longText('license_notes')->nullable();
            $table->longText('license_attachment')->nullable();
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
