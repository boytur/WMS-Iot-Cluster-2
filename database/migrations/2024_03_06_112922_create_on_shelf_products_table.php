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
        Schema::create('wms_onshelf_products', function (Blueprint $table) {
            $table->integer('on_prod_id')->autoIncrement()->nullable(false);
            $table->integer('on_prod_amount')->nullable(false);
            $table->string('on_prod_status')->nullable(false)->default('initialize');
            $table->string('on_prod_note')->nullable();

            $table->integer('space_id')->nullable(false);
            $table->integer('inbound_id')->nullable(false);
            $table->timestamps();

            $table->foreign('space_id')->references('space_id')->on('wms_spaces')->onDelete('cascade');
            $table->foreign('inbound_id')->references('inbound_id')->on('wms_inbound_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wms_on_shelf_products');
    }
};
