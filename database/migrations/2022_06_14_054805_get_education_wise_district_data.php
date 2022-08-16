<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GetEducationWiseDistrictData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_education_wise_district_data`;
        CREATE PROCEDURE `get_education_wise_district_data`()
        BEGIN
        SELECT `presentDivisionId`,`presentDistrictId`,`presentUpazilaId`,`education` , COUNT(*) as `total` FROM `fishermen_info_stats_infos` GROUP BY `presentDivisionId`,`presentDistrictId`,`presentUpazilaId`,`education`;
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
