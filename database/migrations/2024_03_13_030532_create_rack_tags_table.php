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
        Schema::create('wms_rack_tags', function (Blueprint $table) {

            $table->integer('rack_tag_id')->nullable(false)->autoIncrement();
            $table->integer('tag_id')->nullable(false);
            $table->integer('rack_id')->nullable(false);
            $table->timestamps();

            $table->foreign('rack_id')->references('rack_id')->on('wms_racks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wms_rack_tags');
    }
};
