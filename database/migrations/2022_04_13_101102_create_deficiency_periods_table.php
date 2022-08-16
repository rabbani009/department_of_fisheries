<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeficiencyPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deficiency_periods', function (Blueprint $table) {
            $table->id();
            $table->integer('deficiencyPeriodId')->unsigned();
            $table->string('deficiencyPeriodBng',20);
            $table->string('deficiencyPeriodEng',20);
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
        Schema::dropIfExists('deficiency_periods');
    }
}
