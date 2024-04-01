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
        Schema::create('wms_outbound_orders', function (Blueprint $table) {
            $table->integer('outbound_id')->autoIncrement()->nullable(false);
            $table->integer('outbound_amount')->nullable(false);
            $table->string('outbound_status')->nullable(false)->default('initialize');
            $table->date('outbound_exp')->nullable(false);

            $table->integer('mas_prod_id')->nullable(false);
            $table->integer('lot_out_id')->nullable(false);

            $table->timestamps();
            $table->foreign('mas_prod_id')->references('mas_prod_id')->on('wms_master_products')->onDelete('cascade');
            $table->foreign('lot_out_id')->references('lot_out_id')->on('wms_lot_outs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wms_out_bound_orders');
    }
};
