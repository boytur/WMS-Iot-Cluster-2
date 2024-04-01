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
        Schema::create('wms_inbound_orders', function (Blueprint $table) {
            $table->integer('inbound_id')->autoIncrement()->nullable(false);
            $table->integer('inbound_amount')->nullable(false);
            $table->string('inbound_status')->nullable(false)->default('initialize');
            $table->date('inbound_exp')->nullable(false);

            $table->integer('mas_prod_id')->nullable(false);
            $table->integer('lot_in_id')->nullable(false);

            $table->timestamps();
            $table->foreign('mas_prod_id')->references('mas_prod_id')->on('wms_master_products')->onDelete('cascade');
            $table->foreign('lot_in_id')->references('lot_in_id')->on('wms_lot_ins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wms_inbound_orders');
    }
};
