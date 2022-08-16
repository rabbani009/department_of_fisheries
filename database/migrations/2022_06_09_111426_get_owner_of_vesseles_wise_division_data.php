<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GetOwnerOfVesselesWiseDivisionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_owner_of_vesseles_wise_division_data`;
        CREATE PROCEDURE `get_owner_of_vesseles_wise_division_data`()
        BEGIN
        SELECT `presentDistrictId`,`ownerOfVessels` , COUNT(*) as `total` FROM `fishermen_info_stats_infos` GROUP BY `presentDistrictId`,`ownerOfVessels`;
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
