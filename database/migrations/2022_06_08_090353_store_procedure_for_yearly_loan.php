<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoreProcedureForYearlyLoan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_yearly_loan_wise_data`;
        CREATE PROCEDURE `get_yearly_loan_wise_data`()
        BEGIN
        SELECT `presentDivisionId`,`yearlyLoan`, COUNT(*) as `total` FROM `fishermen_info_stats_infos` GROUP BY `presentDivisionId`,`yearlyLoan`;
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
