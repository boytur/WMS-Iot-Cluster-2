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
        Schema::create('master_product_tags', function (Blueprint $table) {

            $table->integer('mas_tag_id')->nullable(false)->autoIncrement();
            $table->integer('tag_id')->nullable(false);
            $table->integer('mas_prod_id')->nullable(false);
            $table->timestamps();

            $table->foreign('mas_prod_id')->references('mas_prod_id')->on('master_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_product_tags');
    }
};
