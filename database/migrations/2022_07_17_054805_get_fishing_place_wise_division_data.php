<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GetFishingPlaceWiseDivisionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_fishing_place_wise_division_data`;
        CREATE PROCEDURE `get_fishing_place_wise_division_data`()
        BEGIN
        select `presentDistrictId`,`placeOfFishing`, COUNT(*) as `total` from `fishermen_info_stats_infos` group by `presentDistrictId`,`placeOfFishing` order by `placeOfFishing`;
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
