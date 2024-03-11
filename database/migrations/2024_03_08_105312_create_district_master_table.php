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
        Schema::create('district_master', function (Blueprint $table) {
            $table->id();
            $table->string('district');
            $table->bigInteger('unique_code');
            $table->bigInteger('district_number');
            $table->string('district_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('district_master');
    }
};
