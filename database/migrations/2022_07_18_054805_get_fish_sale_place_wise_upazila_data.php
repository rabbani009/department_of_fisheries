<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GetFishSalePlaceWiseUpazilaData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_fish_sale_place_wise_upazila_data`;
        CREATE PROCEDURE `get_fish_sale_place_wise_upazila_data`()
        BEGIN
        select `presentDivisionId`,`presentDistrictId`,`presentUpazilaId`,`presentAddressMunicipality`,`presentAddressUnion`,`salePlaceOfFish`, COUNT(*) as `total` from `fishermen_info_stats_infos` group by `presentDivisionId`,`presentDistrictId`,`presentUpazilaId`,`presentAddressMunicipality`,`presentAddressUnion`,`salePlaceOfFish` order by `salePlaceOfFish`;
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
