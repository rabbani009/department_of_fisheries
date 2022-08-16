<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GetFishSalePlaceWiseData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_fish_sale_place_wise_data`;
        CREATE PROCEDURE `get_fish_sale_place_wise_data`()
        BEGIN
        select `presentDivisionId`,`salePlaceOfFish`, COUNT(*) as `total` from `fishermen_info_stats_infos` group by `presentDivisionId`,`salePlaceOfFish` order by `salePlaceOfFish`;
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
