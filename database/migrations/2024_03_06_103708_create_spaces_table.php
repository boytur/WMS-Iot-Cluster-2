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
        Schema::create('wms_spaces', function (Blueprint $table) {
            $table->integer('space_id')->autoIncrement()->nullable(false);
            $table->string('space_name',45)->nullable(false);
            $table->integer('space_capacity')->nullable(false)->default(0);

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
        Schema::dropIfExists('wms_spaces');
    }
};
