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
        Schema::create('district_user_map', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('department_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('district_unique_code');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('district_unique_code')->references('unique_code')->on('district_master')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('department_id')->references('id')->on('department');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('district_user_map');
    }
};
