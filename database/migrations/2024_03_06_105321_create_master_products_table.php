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
        Schema::create('wms_master_products', function (Blueprint $table) {
            $table->integer('mas_prod_id')->autoIncrement()->nullable(false);
            $table->string('mas_prod_no', 45)->nullable(false);
            $table->string('mas_prod_barcode', 13)->nullable();
            $table->string('mas_prod_name', 225)->nullable(false);
            $table->string('mas_prod_image', 225)->nullable();
            $table->integer('mas_prod_size')->nullable(true);

            $table->integer('cat_id')->nullable(false);
            $table->timestamps();

            $table->foreign('cat_id')->references('cat_id')->on('wms_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wms_master_products');
    }
};
