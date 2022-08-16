<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unions', function (Blueprint $table) {
            $table->id();
            $table->integer('divisionId');
            $table->integer('districtId');
            $table->integer('upazilaId');
            $table->integer('municipalityId');
            $table->integer('unionId');
            $table->string('unionBng');
            $table->string('unionEng');
            $table->integer('dataUpdateBy');
            $table->string('dataUpdateIp');
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
        Schema::dropIfExists('unions');
    }
}
