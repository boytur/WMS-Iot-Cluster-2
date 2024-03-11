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
        Schema::create('racks', function (Blueprint $table) {
            $table->integer('rack_id')->autoIncrement()->nullable(false);
            $table->string('rack_name', 45)->nullable(false);
            $table->integer('rack_height')->nullable(false);
            $table->integer('rack_width')->nullable(false);

            $table->integer('wh_id')->nullable(false);
            $table->timestamps();

            $table->foreign('wh_id')->references('wh_id')->on('warehouses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('racks');
    }
};
