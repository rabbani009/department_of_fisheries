<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpazilasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upazilas', function (Blueprint $table) {
            $table->id();
            $table->integer('divisionId');
            $table->integer('districtId');
            $table->integer('upazilaId');
            $table->string('upazilaBng');
            $table->string('upazilaEng');
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
        Schema::dropIfExists('upazilas');
    }
}
