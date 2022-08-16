<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GetGenderWiseUnionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure =  "DROP PROCEDURE IF EXISTS `get_gender_wise_union_data`;
        CREATE PROCEDURE `get_gender_wise_union_data`()
        BEGIN
        SELECT `divisionId`,`districtId`,`upazilaId`,`municipalityId`,`unionId`,`gender` , COUNT(*) as `total` FROM `fishermen_info_card_prints` GROUP BY `divisionId`,`districtId`,`upazilaId`,`municipalityId`,`unionId`,`gender`;
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
