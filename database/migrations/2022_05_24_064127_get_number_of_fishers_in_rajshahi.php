<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GetNumberOfFishersInRajshahi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_number_of_fishers_in_rajshahi`;
        CREATE PROCEDURE `get_number_of_fishers_in_rajshahi`()
        BEGIN
        SELECT `divisionId`,`gender` , COUNT(*) as `total` FROM `fishermen_info_card_prints` GROUP BY `divisionId`,`gender`;
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
        Schema::table('rajshahi', function (Blueprint $table) {
            //
        });
    }
}
