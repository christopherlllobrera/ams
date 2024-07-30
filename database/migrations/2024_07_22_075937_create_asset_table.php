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
            $table->foreignId('companies_id');
            $table->string('asset_tag');
            $table->string('asset_name');
            $table->foreignId('asset_models_id');
            $table->string('serial_number')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('locations_id')->nullable();
            $table->date('purchase_date')->nullable();
            $table->foreignId('supplier_id')->nullable();
            $table->string('order_number')->nullable();
            $table->string('purchase_cost')->nullable();
            $table->string('warranty')->nullable();
            $table->longText('asset_note')->nullable();
            $table->boolean('requestable')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('assigned_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('asset_actions')->nullable();
            $table->string('purchase_order_number')->nullable();
            $table->string('purchase_receipt')->nullable();
            $table->string('delivery_receipt')->nullable();
            $table->string('warranty_terms')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('processor')->nullable();
            $table->string('generation')->nullable();
            $table->string('ram')->nullable();
            $table->string('hdd')->nullable();
            $table->string('ssd')->nullable();
            $table->string('gpu')->nullable();
            $table->string('color')->nullable();
            $table->string('mac_wifi')->nullable();
            $table->string('mac_lan')->nullable();
            $table->string('cost_center')->nullable();
            $table->string('trend_micro')->nullable();
            $table->string('rapid_seven')->nullable();
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
