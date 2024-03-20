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
        Schema::connection('conn_golaghat')->create('schemes', function (Blueprint $table) {
            $table->id("scheme_id");
            $table->string('scheme_name');
            $table->string('scheme_description');
            $table->string('start_date');
            $table->string('end_date');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('conn_golaghat')->dropIfExists('schemes');
    }
};
