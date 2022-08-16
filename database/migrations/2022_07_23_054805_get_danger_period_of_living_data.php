<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GetDangerPeriodOfLivingData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_danger_period_of_living_data`;
        CREATE PROCEDURE `get_danger_period_of_living_data`()
        BEGIN
        SELECT `dangerPeriodOfLiving` , COUNT(*) as `total` FROM `fishermen_info_stats_infos` GROUP BY `dangerPeriodOfLiving`;
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
