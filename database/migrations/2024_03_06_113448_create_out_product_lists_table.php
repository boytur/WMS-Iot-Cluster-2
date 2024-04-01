<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wms_out_product_lists', function (Blueprint $table) {
            $table->integer('out_prod_list_id')->autoIncrement()->nullable(false);
            $table->integer('out_prod_list_amount')->nullable();

            $table->integer('on_prod_id')->nullable(false);
            $table->integer('outbound_id')->nullable(false);

            $table->timestamps();
            $table->foreign('on_prod_id')->references('on_prod_id')->on('wms_onshelf_products')->onDelete('cascade');
            $table->foreign('outbound_id')->references('outbound_id')->on('wms_outbound_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wms_out_product_lists');
    }
};
