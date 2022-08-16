<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GetFishingTimeWiseUpazilaData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_fishing_time_wise_upazila_data`;
        CREATE PROCEDURE `get_fishing_time_wise_upazila_data`()
        BEGIN
        SELECT `presentDivisionId`,`presentDistrictId`,`presentUpazilaId`,`presentAddressMunicipality`,`presentAddressUnion`,`timeOfFishing` , COUNT(*) as `total` FROM `fishermen_info_stats_infos` GROUP BY `presentDivisionId`,`presentDistrictId`,`presentUpazilaId`,`presentAddressMunicipality`,`presentAddressUnion`,`timeOfFishing`;
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
