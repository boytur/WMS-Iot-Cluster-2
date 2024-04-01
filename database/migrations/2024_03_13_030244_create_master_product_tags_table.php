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
        Schema::create('wms_master_product_tags', function (Blueprint $table) {

            $table->integer('mas_tag_id')->nullable(false)->autoIncrement();
            $table->integer('tag_id')->nullable(false);
            $table->integer('mas_prod_id')->nullable(false);
            $table->timestamps();

            $table->foreign('mas_prod_id')->references('mas_prod_id')->on('wms_master_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wms_master_product_tags');
    }
};
