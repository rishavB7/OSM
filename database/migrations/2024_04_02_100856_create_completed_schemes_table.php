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
            // 'conn_bajali',
            // 'conn_baksa',
            // 'conn_barpeta',
            // 'conn_biswanath',
            // 'conn_bongaigaon',
            // 'conn_cachar',
            // 'conn_charaideo',
            // 'conn_chirang',
            // 'conn_darrang',
            // 'conn_dhemaji',
            // 'conn_dhubri',
            // 'conn_dibrugarh',
            // 'conn_dimahasao',
            // 'conn_goalpara',
            // 'conn_golaghat',
            // 'conn_hailakandi',
            // 'conn_hojai',
            'conn_jorhat',
            // 'conn_kamrup_metropolitan',
            // 'conn_kamrup',
            // 'conn_karbi_anglong',
            // 'conn_karimganj',
            // 'conn_kokrajhar',
            // 'conn_lakhimpur',
            // 'conn_majuli',
            // 'conn_morigaon',
            // 'conn_nagaon',
            // 'conn_nalbari',
            // 'conn_shivsagar',
            // 'conn_sonitpur',
            // 'conn_south_salmara_mancachar',
            // 'conn_tamulpur',
            // 'conn_tinsukia',
            // 'conn_udalguri',
            // 'conn_west_karbi_anglong',
        ];

        for($dbcnt = 0; $dbcnt < count($dbname); $dbcnt++){
        Schema::connection($dbname[$dbcnt])->create('completed_schemes', function (Blueprint $table) {
            $table->id();
            $table->string('scheme_name');
            $table->string('scheme_description');
            $table->string('start_date');
            $table->string('end_date');       
            $table->text('physical_progress')->nullable();
            $table->decimal('percentage_of_progress')->nullable();
            $table->string('img1')->nullable();
            $table->string('img2')->nullable();
            $table->string('img3')->nullable();
            $table->string('img4')->nullable();
            $table->date('completion_year');
            $table->string('achievement');
            $table->timestamps();

        }); 
    }                
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('conn_golaghat')->dropIfExists('completed_schemes');
    }
};