<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GetNumberOfFishersInRangpur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_number_of_fishers_in_rangpur`;
        CREATE PROCEDURE `get_number_of_fishers_in_rangpur`()
        BEGIN
        SELECT COUNT(id) AS number FROM fishermen_info_stats_infos where presentDivisionId=55;
        END;";  
        \DB::unprepared($store_procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rangpur', function (Blueprint $table) {
            //
        });
    }
}
