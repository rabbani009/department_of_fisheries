<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardPrintPhaseLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_print_phase_logs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('phase');
            $table->string('divisionId',2);
            $table->string('districtId',2);
            $table->string('upazillaId',2);
            $table->integer('sendBy');
            $table->dateTime('sendDateTime');
            $table->string('sendIp',15);
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
        Schema::dropIfExists('card_print_phase_logs');
    }
}
