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
        Schema::create('wms_warehouses', function (Blueprint $table) {
            $table->integer('wh_id')->autoIncrement()->nullable(false);
            $table->string('wh_name')->nullable(false);
            $table->string('wh_location', 1000)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wms_warehouses');
    }
};
