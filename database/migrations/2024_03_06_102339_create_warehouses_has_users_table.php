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
        Schema::create('warehouses_has_users', function (Blueprint $table) {
            $table->integer('wh_id')->nullable(false);
            $table->integer('user_id')->nullable(false);
            $table->timestamps();

            $table->foreign('wh_id')->references('wh_id')->on('warehouses')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses_has_users');
    }
};
