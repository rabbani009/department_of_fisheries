<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->integer('villageId')->unsigned();
            $table->integer('divisionId');
            $table->integer('districtId');
            $table->integer('upazillaId');
            $table->integer('municipalityId');
            $table->integer('unionId');
            $table->string('villageEng',191);
            $table->string('villageBng',191);
            $table->string('dataEntryBy');
            $table->datetime('dataEntryDate');
            $table->string('dataEntryIp',191);
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
        Schema::dropIfExists('villages');
    }
}
