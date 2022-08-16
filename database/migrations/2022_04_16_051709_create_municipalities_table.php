<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipalities', function (Blueprint $table) {
            $table->id();
            $table->integer('municipalitiesId')->unsigned();
            $table->integer('divisionId');
            $table->integer('districtId');
            $table->integer('upazillaId');
            $table->integer('municipalityId');
            $table->string('municipalityBangla',100);
            $table->string('municipalityEnglish',100);
            $table->integer('dataUpdatedBy');
            $table->string('dataUpdateIp',100);
            $table->datetime('dataUpdateDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipalities');
    }
}
