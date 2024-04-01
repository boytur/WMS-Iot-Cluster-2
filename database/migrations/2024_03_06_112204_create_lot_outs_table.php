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
        Schema::create('wms_lot_outs', function (Blueprint $table) {
            $table->integer('lot_out_id')->autoIncrement()->nullable(false);
            $table->string('lot_out_number', 45)->nullable(false);
            $table->string('lot_out_status', 45)->nullable(false)->defaultValue('initialize');

            $table->integer('wh_id')->nullable(false);
            $table->integer('user_id')->nullable(false);
            $table->timestamps();

            $table->foreign('wh_id')->references('wh_id')->on('wms_warehouses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wms_lot_outs');
    }
};
