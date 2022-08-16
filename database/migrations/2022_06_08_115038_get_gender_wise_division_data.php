<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GetGenderWiseDivisionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_gender_wise_division_data`;
        CREATE PROCEDURE `get_gender_wise_division_data`()
        BEGIN
        SELECT `districtId`,`gender` , COUNT(*) as `total` FROM `fishermen_info_card_prints` GROUP BY `districtId`,`gender`;
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
        //
    }
}
