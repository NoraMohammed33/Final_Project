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
        Schema::disableForeignKeyConstraints();

        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept_id');
            $table->longText('bio');
            $table->unsignedBigInteger('user_id');
            $table->foreign('dept_id')->references('id')->on('departments');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experts');
    }
};
