<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GetGenderWiseDistrictAndUpazilaData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_gender_wise_district_and_upazila_data`;
        CREATE PROCEDURE `get_gender_wise_district_and_upazila_data`()
        BEGIN
        SELECT `divisionId`,`districtId`,`upazilaId`,`gender` , COUNT(*) as `total` FROM `fishermen_info_card_prints` GROUP BY `divisionId`,`districtId`,`upazilaId`,`gender`;
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
