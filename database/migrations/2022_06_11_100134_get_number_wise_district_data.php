<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GetNumberWiseDistrictData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_number_wise_district_data`;
        CREATE PROCEDURE `get_number_wise_district_data`()
        BEGIN
        SELECT `divisionId`,`districtId`,`upazilaId`, COUNT(*) as `total` FROM `fishermen_info_card_prints` GROUP BY `divisionId`,`districtId`,`upazilaId`;
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
