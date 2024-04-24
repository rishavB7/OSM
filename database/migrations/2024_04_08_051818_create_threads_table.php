<?php

use Cmgmyr\Messenger\Models\Models;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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

        // for($dbcnt = 0; $dbcnt < count($dbname); $dbcnt++){
        Schema::create(Models::table('threads'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->timestamps();
        });
    // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Models::table('threads'));
    }
}