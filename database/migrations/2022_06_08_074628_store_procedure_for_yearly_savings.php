<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoreProcedureForYearlySavings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_yearly_saving_wise_data`;
        CREATE PROCEDURE `get_yearly_saving_wise_data`()
        BEGIN
        SELECT `presentDivisionId`,`yearlySaving`, COUNT(*) as `total` FROM `fishermen_info_stats_infos` GROUP BY `presentDivisionId`,`yearlySaving`;
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
