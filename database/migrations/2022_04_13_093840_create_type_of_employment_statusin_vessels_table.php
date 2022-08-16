<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeOfEmploymentStatusinVesselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_of_employment_status_in_vessels', function (Blueprint $table) {
            $table->id();
            $table->integer('vesselsEmploymentId');
            $table->string('employmentsInVesselsBng',30);
            $table->string('employmentsInVesselsEng',30);
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
        Schema::dropIfExists('type_of_employment_statusin_vessels');
    }
}
