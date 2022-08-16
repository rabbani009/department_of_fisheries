<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGenderWiseData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_gender_wise_data`;
        CREATE PROCEDURE `get_gender_wise_data`()
        BEGIN
        SELECT `divisionId`,`gender` , COUNT(*) as `total` FROM `fishermen_info_card_prints` GROUP BY `divisionId`,`gender`;
        END;";  
        DB::unprepared($store_procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gender_wise_data');
    }
}
