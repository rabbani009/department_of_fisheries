<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishingEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fishing_equipment', function (Blueprint $table) {
            $table->id();
            $table->integer('equipmentId')->unsigned();
            $table->string('equipmentEng',25);
            $table->string('equipmentBng',25);
            $table->integer('activeStatus');
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
        Schema::dropIfExists('fishing_equipment');
    }
}
