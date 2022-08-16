<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnerOfVesselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owner_of_vessels', function (Blueprint $table) {
            $table->id();
            $table->integer('vesselsOwnerId');
            $table->string('ownerOfVesselsBng');
            $table->string('ownerOfVesselsEng');
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
        Schema::dropIfExists('owner_of_vessels');
    }
}
