<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGetFishCategoryWiseDataStoreProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_fish_category_wise_data`;
        CREATE PROCEDURE `get_fish_category_wise_data`()
        BEGIN
        select `presentDivisionId`,`typeOfFish`, COUNT(*) as `total` from `fishermen_info_stats_infos` group by `presentDivisionId`,`typeOfFish` order by `typeOfFish`;
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
        Schema::dropIfExists('get_fish_category_wise_data_store_procedure');
    }
}
