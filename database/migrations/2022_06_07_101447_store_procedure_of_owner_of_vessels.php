<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoreProcedureOfOwnerOfVessels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_owner_of_vesseles_wise_data`;
        CREATE PROCEDURE `get_owner_of_vesseles_wise_data`()
        BEGIN
        SELECT `presentDivisionId`,`ownerOfVessels` , COUNT(*) as `total` FROM `fishermen_info_stats_infos` GROUP BY `presentDivisionId`,`ownerOfVessels`;
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
