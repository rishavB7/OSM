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

        $dbname= [
            
            
            // 'conn_lakhimpur',
            'conn_golaghat'
        ];

        for($dbcnt = 0; $dbcnt < count($dbname); $dbcnt++){
            Schema::connection($dbname[$dbcnt])->create('department_user_map', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('department_master');
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_user_map');
    }
};
