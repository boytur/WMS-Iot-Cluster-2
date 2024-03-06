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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('user_id')->autoIncrement()->nullable(false);
            $table->string('user_number',)->nullable(false);
            $table->string('user_fname',225)->nullable(false);
            $table->string('user_lname',225)->nullable(false);
            $table->string('user_email',225)->nullable(false)->unique();
            $table->string('user_password',225)->nullable(false);
            $table->string('user_phone',10)->nullable();
            $table->string('user_role')->nullable(false)->default('normal_employee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
