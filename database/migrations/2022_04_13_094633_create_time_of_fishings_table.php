<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeOfFishingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_of_fishings', function (Blueprint $table) {
            $table->id();
            $table->integer('fishingTimeId');
            $table->string('timeOfFishingBng',30);
            $table->string('timeOfFishingEng',30);
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
        Schema::dropIfExists('time_of_fishings');
    }
}
