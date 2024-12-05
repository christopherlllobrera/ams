<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->nullable();
            $table->string('company_number')->nullable();
            $table->string('asset_code')->nullable();
            $table->string('asset_type')->nullable();
            $table->string('asset_categories')->nullable();
            $table->string('asset_model_id')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('assetlifecycle_id')->nullable();
            $table->string('location_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('project_id')->nullable();
            $table->longText('asset_note')->nullable();
            //purchase details
            $table->string('depreciation_cost')->nullable();
            $table->string('depreciation_year')->nullable();
            $table->string('EOL_date')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('purchase_receipt')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('purchase_order')->nullable();
            $table->string('purchase_cost')->nullable();
            $table->string('good_receipt')->nullable();
            $table->string('delivery_receipt')->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('start_of_warranty')->nullable();
            $table->date('end_of_warranty')->nullable();
            $table->longText('asset_attachment')->nullable();

            //specs
            $table->string('operating_system')->nullable();
            $table->string('processor')->nullable();
            $table->string('RAM')->nullable();
            $table->string('storage')->nullable();
            $table->string('GPU')->nullable();
            $table->string('color')->nullable();
            $table->string('MAC_address')->nullable();
            $table->longText('image')->nullable();
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
