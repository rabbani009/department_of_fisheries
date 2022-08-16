<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellsCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells_centers', function (Blueprint $table) {
            $table->id();
            $table->integer('sellsCenterId');
            $table->string('sellsCenterEng');
            $table->string('sellsCenterBng');
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
        Schema::dropIfExists('sells_centers');
    }
}
